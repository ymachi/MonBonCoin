<?php
namespace Controllers;

class Controller{
    // Méthode render() qui permet d'envoyer les données à la bonne vue 
    public static function render($views, $data = []){
        // on utilise extract() pour créer autant de variables que des clés présentents dans le tableau data 
        extract($data);

        // On commence à mettre en mémoire tampon
        ob_start();

        // On appelle la bonne vue 
        require_once('../Views/'. $views . '.php');
        $content = ob_get_clean(); // la méthode ob_get_clean envoie tout ce qui est en mémoire dans la variable et vide la mémoire

        require_once('../Views/layout.php');

    }
     
    
}