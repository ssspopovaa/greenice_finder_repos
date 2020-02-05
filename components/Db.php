<?php

/**
 * Db class
 * Component for work with database
 */
class Db
{
    /**
     * @return \PDO <p>PDO object for work with database</p>
     */
    public static function getConnection()
    {
        // get param connection
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include($paramsPath);

 try {
        // Set connection
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
    
        $db = new PDO($dsn, $params['user'], $params['password']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Set charset
        $db->exec("set names utf8");
        
    } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

        return $db;
    }
}
