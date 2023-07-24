<?php

namespace App;

use PDO;
use PDOException;

class Db {
    private static $db; // pour stocker mon objet PDO

    // Singleton
    static function getDb(){
        if(!self::$db){
            try {
                // Chemin vers config.json pour le dossier public
                // $config = file_get_contents('../App/config.json');
                // Chemin vers config.json pour le dossier racine
                 $config = file_get_contents('App/config.json');
                // var_dump($config);
                // Pour pouvoir utiliser un fichier json il faut le decoder
                $config = json_decode($config);
                var_dump($config);
                // on crée l'objet PDO
               self::$db = new PDO ("mysql:host=" . $config->host . ";dbname=" . $config->dbName, $config->user, $config->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'') );
            } catch (PDOException $err) {
                echo "Problème de connexion à la BDD " . $err->getMessage();
            }
        }
         return self::$db;
    }
}

// $test = new Db;
// $test::getDb();
