<?php 
namespace Controllers;

class Users extends Controller{
    public static function connexion(){
        // pour vérifier si le formulaire a été soumis nous pouvons utiliser la super globale $_SERVER (cette méthode ne fonctionne qu'avec un formulaire en POST)
        // var_dump($_SERVER);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
           // echo 'le formulaire est soumis';
           // Il faut toujours sécuriser les saisies utilisateurs
        }

        self::render('users/connexion',[
            'title' => 'Vous pouvez vous connecter'
        ]);
    }
}
?>