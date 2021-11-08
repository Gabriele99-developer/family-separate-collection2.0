<?php

class Connection
{
    public static function make ()
    {
        try {
            return new PDO('mysql:host=;DBNAME=collectiondb','root','');
        } catch (PDOException $e){
            die($e->getMessage());
        }
    }
}

$pdo= Connection::make();

?>