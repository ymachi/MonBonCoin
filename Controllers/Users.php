<?php

namespace Controllers;

use Controllers\Controller;

class Users extends Controller
{

    public static function connexion()
    {
        // pour vérifier si le formulaire a été soumis nous pouvons utiliser la super globale $_SERVER (cette méthode ne fonctionne qu'avec un formulaire en POST)
        // var_dump($_SERVER);
        $errMsg = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
                    // L'utilisateur est correcte
                    $_SESSION['message'] = "Salut, content de vous revoir.";
                    $_SESSION['user'] = [
                        'role' => $user['role'],
                        'id' => $user['idUser'],
                        'firstName' => $user['firstName'],
                    ];
                    // Quand l'utilisateur est connecter on le redirige vers la  route de notre choix
                    header('Location: /');
                } else {
                    $errMsg = "Le login et / ou le mot de passe est incorrect";
                }
            }
        }

        self::render('users/connexion', [
            'title' => 'Vous pouvez vous connecter ',
            'messageErreur' => $errMsg
        ]);
    }
    public static function deconnexion()
    {
        unset($_SESSION['user']);
        $_SESSION['message'] = "À bientôt !";
        header('Location: /');
    }

    public static function inscription()
    {
        $errMsg = "";
        // Regex du mot de psse (minimuum 8 caracteres)
        $pattern = '/^.{8}$/';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['login']) || !filter_var($_POST['login'], FILTER_VALIDATE_EMAIL)) {
                // On vérifie que tous les champs sont remplis 
                $errMsg .= 'Merci de saisir votre email valide. <br>';
            }
            if (empty($_POST['firstName'])) {
                $errMsg .= 'Merci de saisir votre prénom. <br>';
            }
            if (empty($_POST['lastName'])) {
                $errMsg .= 'Merci de saisir votre nom. <br>';
            }
            if (empty($_POST['address'])) {
                $errMsg .= 'Merci de saisir votre adresse. <br>';
            }
            if (empty($_POST['cp'])) {
                $errMsg .= 'Merci de saisir votre code postale. <br>';
            }
            if (empty($_POST['city'])) {
                $errMsg .= 'Merci de saisir votre ville. <br>';
            }
            if (empty($_POST['password'])) {
                $errMsg .= 'Merci de saisir votre mot de passe. <br>';
            }
            if (empty($_POST['confirm'])) {
                $errMsg .= 'Merci de confirmer votre mot de passe.<br>';
            }
            // On vérifie si les mdp sont conformes
            if ($_POST['password'] == $_POST['confirm'] && preg_match($pattern, $_POST['password'])) {
                // je sécurise les saisies
                self::security();
                $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

                // je créer un tableau qui contient les infos d'useer
                $dataUser = [];
                foreach ($_POST as $key => $value) {
                    if ($key != 'confirm') {
                        $dataUser[] = $value;
                    }
                }
                // On enreistre en BBD 
                \Models\Users::create($dataUser);
                $_SESSION['message'] = "Votre compte est crée, vous pouvez vous connecter.";
                header('Location: /connexion');
            } else {
                $errMsg = "Les deux mot de passe ne sont pas identiques ou ne contiennent pas 8 caractères. ";
            }
        }

        self::render('users/inscription', [
            'title' => 'Merci de remplir ce formulaire pour vous inscrire.',
            'erreurMessage' => $errMsg
        ]);
    }
}
