<?php

namespace Models;
use App\Db;
use PDO;

class Products extends Db{
    // CRUD
    //1// Méthode de lectures

    // Tous les produits
    public static function findAll($order = null, $limit = null){
        // pour récupérer les noms des catégories on doit faire une jointure
        $request = "SELECT *, products.title AS productTitle, categories.title AS catTitle FROM products INNER JOIN categories ON products.idCategory = categories.idCategory";
        // on voudrait pouvoir ordonner les réponses par prix
        // if($order){
           // $request .= "ORDER BY price $order";}
           $order ? $request .= " ORDER BY $order" : null;
           $limit ? $request .= " LIMIT $limit" : null;
       
        $response = self::getDb()->prepare($request);
        $response->execute();
        return $response->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById($id){
        $request = "SELECT *, products.title AS productTitle, categories.title AS catTitle FROM products INNER JOIN categories ON products.idCategory = categories.idCategory WHERE idProduct = :idProduct";
        $reponse = self::getDb()->prepare($request);
        $reponse->bindvalue(":idProduct", $id, PDO::PARAM_INT);
        $reponse->execute();

        return $reponse->fetch(PDO::FETCH_ASSOC);



    }
    public static function findByUser($idUser){
        $request = "SELECT *, products.title AS productTitle, categories.title AS catTitle FROM products INNER JOIN categories ON products.idCategory = categories.idCategory WHERE idUser = :idUser";
        $reponse = self::getDb()->prepare($request);
        $reponse->bindvalue(":idUser", $idUser, PDO::PARAM_INT);
        $reponse->execute();

        return $reponse->fetchAll(PDO::FETCH_ASSOC);

    }

    public static function findByCat($idCategory, $order = null){
        $request = "SELECT *, products.title AS productTitle, categories.title AS catTitle FROM products INNER JOIN categories ON products.idCategory = categories.idCategory WHERE products.idCategory = :idCategory";
        // Attention le champs idCategory est présent dans les deux tables donc il faut préciser le nom de la table dans where
        $order ? $request .= " ORDER BY $order" : null;
        $reponse = self::getDb()->prepare($request);
        $reponse->bindvalue(":idCategory", $idCategory, PDO::PARAM_INT);
        $reponse->execute();

        return $reponse->fetchAll(PDO::FETCH_ASSOC);
    }
 
    // les méthodes d'écriture 
    // 1 create
    public static function create(array $data){
        $request = "INSERT INTO products (idCategory, idUser, title, description, price, image) VALUES (?, ?, ?, ?, ?, ?)";
        $response = self::getDb()->prepare($request);
        return $response->execute($data);
    }
    // les méthodes d'écriture 
    // 2 / update
    public  static function update(array $data){
        $request = "UPDATE products SET idCategory = ?, idUser =?, title =?, description =?, price =?, image = ? WHERE IdProduct = ?";
        $response = self::getDb()->prepare($request);
        return $response->execute($data);
    }
    // les méthodes d'écriture 
    // 3 / delete
    public static function delete($id){
        $request = "DELETE FROM products WHERE idProduct = :id";
        $reponse = self::getDb()->prepare($request);
        $reponse->bindvalue(":id", $id, PDO::PARAM_INT);

    }

}
