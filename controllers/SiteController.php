<?php

/**
 * SiteController
 */
class SiteController
{
    /**
     * Action for main page
     */
    public function actionIndex($page = 1)
    {
        $errors = false;
        
        //If send form search - remember search string
        if(isset($_POST['search'])) {
            $_SESSION['search'] = $_POST['search'];
        }
        
        // while search string exist in session - use it for right paginations
        if (isset($_SESSION['search']) && strlen($_SESSION['search']) > 0) {
            $name = htmlspecialchars($_SESSION['search']);
            $result = Repos::getReposByName($name, $page);
        
            if(isset($result->total_count) && $result->total_count > 0) {
                $total = $result->total_count;
                $repos = $result->items;
                
                // Create Pagination object
                $pagination = new Pagination($total, $page, Repos::SHOW_BY_DEFAULT, 'page-');
                // view main page
            } else {
                $errors[] = 'Поиск не дал результатов';
            }
        } 
        
        require_once(ROOT . '/views/site/index.php');
       
        return true;
    }
    /**
     * 
     * @param type $page
     * @return boolean
     */
    public function actionFavorite($page = 1) {
        $errors = false;
        $userid = User::checkLogged();
        
        $result = Repos::getFavorite($userid);
        
            if($result && is_array($result)) {
                $total = count($result);
                $repos = $result;
                
                // Create Pagination object
                $pagination = new Pagination($total, $page, 5, 'page-');
                
            } else {
                $errors[] = 'У Вас нет сохраненных репозиториев';
            }

        require_once(ROOT . '/views/site/favorite.php');
       
        return true;
    }

    /**
     * Save Action
     * 
     * @param type $id
     * 
     * @return type
     */
    public function actionSave($id)
    {
        $userId = User::checkLogged();
        
        $repo = Repos::getReposById($id);
        
        if(isset($repo->id)) {
            $ident = $repo->id;
            $name = $repo->name;
            $html_url = $repo->html_url;
            $description = $repo->description;
            $ownerLogin = $repo->owner->login;
            $stargazersCount = $repo->stargazers_count;
            
            $exist = Repos::existingFavorite($ident, $userId);
            if($exist) {
               $_SESSION['message'][] = "Этот репозиторий уже есть в избранных";
               
               $referrer = $_SERVER['HTTP_REFERER'];
               header("Location: $referrer");
               return true;
            }
            $result = Repos::save($ident, $name, $html_url, $description, $ownerLogin, $stargazersCount);
            
            if($result) {
                $_SESSION['message'][] = "Репозиторий сохранен в избранных";   
            } else {
                $_SESSION['message'][] = 'Не удалось сохранить в избранные';
            }
        } else {
            $_SESSION['message'][] = 'Не удалось сохранить в избранные';
        }
            
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    }
    
    /**
     * Delete controller
     * @param type $id
     */
    public function actionDelete($id)
    {
        User::checkLogged();
        
        $result = Repos::deleteFavoriteById($id);
            
            if($result) {
                $_SESSION['message'][] = "Репозиторий c id: " . $id . " удален из избранных";   
            } else {
                $_SESSION['message'][] = 'Не удалось удалить из избранных';
            }
            
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    }
}
