<?php
namespace Controllers;

class Products extends Controller{
    public static function accueil(){
        // echo "vous êtes dans la méthode accueil";
         $products =  \Models\Products::findAll("date DESC", 2);
        // On utilise la méthode render du controller principale pour afficher la bonne vue avec les bonnes infos

        self::render('products/accueil', [
            'title' => 'Les deux derniers produits',
            'products' => $products
        ]);

    }

    // Méthode pour récupérer un broduit par son id 
    public static function detailProduct(){
      // je crée une viariable pour stocker les erreurs potentielles
      $err = "";
        if(isset($_GET['id'])){
        $idProduct = $_GET['id'];
        //cho $idProduct;
        $product = \Models\Products::findByID($idProduct);
        $err = !$product ? "Le produit n'existe pas." : null;
        // echo $err;

        // Apres avoir récupérer le produit je récupère le User propriétaire du produit
        // pour pouvoir utiliser son adresse
        $idUser = $product['idUser'];
        $useProduct = \Models\Users::findById($idUser);
        // jutilise le render
        self::render('products/detailProduct', [
           'title'=> "Détail du produit", 
           'product' => $product,
           'user'=> $useProduct,
           'erreur' => $err
        ]);
        }
      
    }
    // Méthode qui gère la récupération et l'affichage de tous les produits 
    public static function AffichageProducts(){
        // Je récupère tous les produits 
        $products = \Models\Products::findAll();

        // pour mon formulaire de tri, je récupère toutes les catégories
        $categories = \Models\Categories::findAll();
        // J'utilise render() pour envoyer ces produits à la bonne vue
        self::render('products/accueil', [
            'title' => 'Tous les produits Mon Bon Coin',
            'products' => $products,
            'categories' => $categories
        ]);
    }
}

