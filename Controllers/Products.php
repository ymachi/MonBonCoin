<?php
namespace Controllers;

class Products extends Controller{
    public static function accueil(){
        // echo "vous êtes dans la méthode accueil";
         $products =  \Models\Products::findAll();
        // On utilise la méthode render du controller principale pour afficher la bonne vue avec les bonnes infos

        self::render('products/accueil', [
            'title' => 'Les trois derniers produits',
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
    
}

