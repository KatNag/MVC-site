<?php

class Connection
{
    public static function connect()
    {
        global $dbConfig;
        $host = $dbConfig['db_address'];
        $db = $dbConfig['db_name'];
        $charset = 'utf8';
        $login = $dbConfig['db_user'];
        $pass = $dbConfig['db_pass'];
        $pdoOpts = array(
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        if (DEBUG_MODE === true) {
            $pdoOpts[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        }
        return new PDO("mysql:host=$host;dbname=$db;charset=$charset", $login, $pass, $pdoOpts);
    }
}

