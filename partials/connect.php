<?php
    require_once 'config.php';

    function connect($host, $db, $password, $charset){
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        try{
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];
            return new PDO($dsn, $db, $password, $options);
        } catch (PDOException $e){
            die($e->getMessage());
        }
    }
?>