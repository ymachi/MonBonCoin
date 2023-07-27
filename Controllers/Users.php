<?php

namespace Controllers;

class Users extends Controller
{
    public static function connexion()
    {
        // pour vérifier si le formulaire a été soumis nous pouvons utiliser la super globale $_SERVER (cette méthode ne fonctionne qu'avec un formulaire en POST)
        // var_dump($_SERVER);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $errMsg = "";
            // echo 'le formulaire est soumis';
            // Il faut toujours sécuriser les saisies utilisateurs
            // https://www.php.net/manual/fr/function.htmlspecialchars.php
            $login = htmlspecialchars(trim($_POST['login']));
            // On vérifie si le login est présent dans la BDD
            $user = \Models\Users::findByLogin($login);
            if (!$user) {
                $errMsg = "Le login est / ou le mot de passe est incorrect";
            } else {
                //var_dump($user);
                $pass =  htmlspecialchars(trim($_POST['password']));
                if (password_verify($pass, $user['password'])) {
                    echo 'OK';
                } else {
                    $errMsg = "Le login et / ou le mot de passe est incorrect";
                }
            }
        }

        self::render('users/connexion', [
            'title' => 'Vous pouvez vous connecter :',
            'messageErreur' => $errMsg
        ]);
    }
}
