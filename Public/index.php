<?php
// Ce fichier est le point d'entrée de notre site

use App\Routeur;

// Pour gerer les connexions on utilise la session
session_start();
// J'ai maintenant accés à $_SESSION

// echo "point d'entrée de notre site";
// Pour rester sur le fichier index.php quoi qu'il arrive, je dois faire une réécriture d'url
// Une des possibilité est d'utiliser un fichier config du serveur apache qui s'appelle .htaccess
// Nous allons créer ce fichier dans le répertoire Public
// Nous allons aussi créer un virtual host

// On importe l'autoloader
require_once('../autoloader.php');

// On creée un routeur pour gérer les routes 
// On appelle la méthode app()
define('ROOT', dirname(__DIR__));

$routeur = new Routeur;
$routeur->app();

