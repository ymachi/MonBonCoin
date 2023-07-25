<?php

namespace App;

class Routeur{

    private $routes = [
        '/'=> [' controller' => 'Accueil'],
        '/products'=> [' controller'=> 'Produits'],
        '/detailProduct'=> [ 'controller'=> 'Détail du Produit'],
        '/inscription'=> [ 'controller'=> 'Inscription'],
        '/connexion'=> [ 'controller'=> 'Connexion'],
        '/deconnexion'=> [ 'controller'=> 'Deconnexion'],
        '/ajoutProduct'=> [ 'controller'=> 'ajoutProduct'],
        '/modifProduct'=> [ 'controller'=> 'modifProduct'],
        '/suppProduct'=> [ 'controller'=> 'suppProduct'],
        '/panier' => [ 'controller'=> 'Panier'],
    ];

    // je crée une méthode app qui est la méthode centrale de mon site, le fichier index.php ne fera qu'une seule chose : exécuter cette méthode
    public function app(){
    // echo 'le routeur fonctionne';
    // on doit récupérer l'url
    $request = $_SERVER['REQUEST_URI'];
    echo $request;
    // Je ne veux pas récupérer les paramètres dans mes routes
    // donc je casse la chaine de caractère en prenant "?"
     $request = explode("?", $request);
    // var_dump($request);
     $request = $request[0];
     //echo $request;
     // On vérifie si la route ($request, $this->routes)
      if(array_key_exists ($request, $this->routes)){
        echo $this->routes[$request]['controller'];
      } else{
        echo "la page que vous demandez n'existe pas";
      }
    }
}

