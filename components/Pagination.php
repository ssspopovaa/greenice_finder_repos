<?php

/*
 * Class Pagination 
 */

class Pagination
{

    /**
     * 
     * @var Links for navigations
     * 
     */
    private $max = 10;

    /**
     * 
     * @var Key for GET, which draw pages number
     * 
     */
    private $index = 'page';

    private $current_page;

    /**
     * 
     * @var Total entities
     * 
     */
    private $total;

    /**
     * 
     * @var Count entities for a page
     * 
     */
    private $limit;

    /**
     * Run nessesary entities
     * @param type $total 
     * @param type $currentPage 
     * @param type $limit 
     * @param type $index 
     */
    public function __construct($total, $currentPage, $limit, $index)
    {
        $this->total = $total;
        $this->limit = $limit;
        $this->index = $index;
        # Set count pages
        $this->amount = $this->amount();
        $this->setCurrentPage($currentPage);
    }

    /**
     *  For links
     * @return HTML with navigate links
     */
    public function get()
    {
        $links = null;

        # Get limit for loop
        $limits = $this->limits();
        
        $html = '<ul class="pagination justify-content-center">';
        # Links generating
        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            # If current page - no link and add class active
            if ($page == $this->current_page) {
                $links .= '<li class="active page-item"><a href="#">' . $page . '</a></li>';
            } else {
                # Else generate link
                $links .= $this->generateHtml($page);
            }
        }

        if (!is_null($links)) {
            if ($this->current_page > 1)
            # Create link for a first page
                $links = $this->generateHtml(1, '&lt;') . $links;

            # if current is not first
            if ($this->current_page < $this->amount)
            # Create link for a last page
                $links .= $this->generateHtml($this->amount, '&gt;');
        }

        $html .= $links . '</ul>';

        return $html;
    }

    /**
     * For generate html code
     * @param integer $page - page number
     * 
     * @return
     */
    private function generateHtml($page, $text = null)
    {
        // if havn't text
        if (!$text)
        # set text is page number
            $text = $page;

        $currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
        $currentURI = preg_replace('~/page-[0-9]+~', '', $currentURI);
        return
                '<li class="page-item"><a href="' . $currentURI . $this->index . $page . '">' . $text . '</a></li>';
    }

    /**
     * @return array with first and last count
     */
    private function limits()
    {
        # Left link
        $left = $this->current_page - round($this->max / 2);
        
        # count start
        $start = $left > 0 ? $left : 1;

        if ($start + $this->max <= $this->amount) {
            $end = $start > 1 ? $start + $this->max : $this->max;
        } else {
            # End - total count pagesa
            $end = $this->amount;

            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }

        return
                array($start, $end);
    }

    /**
     * Set current page
     * 
     * @return
     */
    private function setCurrentPage($currentPage)
    {
        # Get page number
        $this->current_page = $currentPage;

        if ($this->current_page > 0) {
            if ($this->current_page > $this->amount)
                $this->current_page = $this->amount;
        } else
            $this->current_page = 1;
    }

    /**
     * For gettin total count pages
     * 
     * @return total count pages
     */
    private function amount()
    {
        return ceil($this->total / $this->limit);
    }
}
