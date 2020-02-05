<?php

/**
 * Task model class
 */
class Repos {

    // count repos on page for pagination
    const SHOW_BY_DEFAULT = 30;

    /**
     * 
     * @param type $name
     * @return object
     */    
    public static function getReposByName($name, $page = 1) {
           
        $url = "https://api.github.com/search/repositories?q=$name+in%3Aname&type=Repositories&page=".$page;
        $curlInit = curl_init($url);
        curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);
        curl_setopt ($curlInit, CURLOPT_USERAGENT, "Mozilla");
        
        //Get response
        $response = curl_exec($curlInit);
        curl_close($curlInit);

        return $response = json_decode($response);    
    }

     public static function getReposById($id) {
           
        $url = "https://api.github.com/repositories/" . $id;
        $curlInit = curl_init($url);
        curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);
        curl_setopt ($curlInit, CURLOPT_USERAGENT, "Mozilla");
        
        //Get response
        $response = curl_exec($curlInit);
        curl_close($curlInit);

        return $response = json_decode($response);    
    }
        
    /**
     * Save repos to favorite table
     * 
     * @param type $ident
     * @param type $name
     * @param type $html_url
     * @param type $description
     * @param type $ownerLogin
     * @param type $stargazersCount
     * @return type
     */
    public static function save($ident, $name, $html_url, $description, $ownerLogin, $stargazersCount) {
        // connect to database
        $db = Db::getConnection();

        $userid = User::checkLogged();
               
        // sql for insert data
        $sql = 'INSERT INTO favorite (userid, ident, name, htmlurl, description, ownerlogin, stargazerscount) '
                . 'VALUES (:userid, :ident, :name, :htmlurl, :description, :ownerlogin, :stargazerscount) ';

        // prepare and bind request sql
        $result = $db->prepare($sql);
        
        $result->bindParam(':userid', intval($userid), PDO::PARAM_INT);
        $result->bindParam(':ident', intval($ident), PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':htmlurl', $html_url, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':ownerlogin', $ownerLogin, PDO::PARAM_STR);
        $result->bindParam(':stargazerscount', strval($stargazersCount), PDO::PARAM_STR);
                
        return $result->execute();
    }
    /**
     * Check for a exist repository in favorite
     * 
     * @param type $ident
     * @param type $userid
     * @return boolean
     */
    public static function existingFavorite($ident, $userid) {
        $db = Db::getConnection();

        $sql = 'SELECT id FROM favorite WHERE userid = :userid AND ident = :ident ';

        $result = $db->prepare($sql);
        $result->bindParam(':ident', $ident, PDO::PARAM_INT);
        $result->bindParam(':userid', $userid, PDO::PARAM_INT);
        $result->execute();

        $exist = $result->fetch();

        if ($exist) {
            return $exist['id'];
        }
        return false;
    }
    
    /**
     * 
     * @param type $userid
     * @return type
     */
    public static function getFavorite($userid){
        $db = Db::getConnection();

        $sql = 'SELECT * FROM favorite WHERE userid = :userid ';

        $result = $db->prepare($sql);
        $result->bindParam(':userid', $userid, PDO::PARAM_INT);
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $repos = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $repos[$i]['id'] = $row['id'];
            $repos[$i]['name'] = $row['name'];
            $repos[$i]['htmlurl'] = $row['htmlurl'];
            $repos[$i]['description'] = $row['description'];
            $repos[$i]['ident'] = $row['ident'];
            $repos[$i]['ownerlogin'] = $row['ownerlogin'];
            $repos[$i]['stargazerscount'] = $row['stargazerscount'];
            $i++;
        }
        return $repos;
          
    }
    /**
     * Delete favorite repository by id
     * 
     * @param type $id
     * @return type
     */
    public static function deleteFavoriteById($id) {
        
        $db = Db::getConnection();
        $sql = 'DELETE FROM favorite WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        
        return $result->execute();
    }
}