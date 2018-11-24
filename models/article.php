<?php

//include de la database
include_once path::getClassesPath() . 'database.php';

class articles extends database {

    //déclaration des attributs
    public $id;
    public $name; //nom de l'article
    public $description; //description de l'article
    public $price;
    public $postDate; //date de l'ajout de l'article
    public $endDate; //date de fin pour l'articles si il y en a une
    public $stock; //stock d'objet disponible (pour les utilisateur professionnel)
    public $idUsers;
    public $idCategory;
    public $idLocation; //location de l'objet (lieux);

    /**
     * Méthode pour l'ajout d'un article dans la base de donnée
     */

    public function addArticle() {
        //déclaration de la requete sql
        $request = 'INSERT INTO `p24oi86_article`(`name`,`description`,`price`,`postDate`,`endDate`,`stock`,`idUsers`,`idCategory`,`idLocation`) '
                . 'VALUES (:name, :description, :price, :price, :postDate, :endDate, :stock, :idUsers, :idCategory, :idLocation)';
        $insertArticle = $this->db->prepare($request);
        //        blind value permet de mettre une valeur a notre marqueur nominatif, il nous protége un minimum des injection sql
        //        on utilise un bind value pour chaque clé nominatif
        $insertArticle->bindValue(':name', $this->name, PDO::PARAM_STR);
        $insertArticle->bindValue(':description', $this->description, PDO::PARAM_STR);
        $insertArticle->bindValue(':price', $this->price, PDO::PARAM_INT);
        $insertArticle->bindValue(':postDate', $this->postDate, PDO::PARAM_STR);
        $insertArticle->bindValue(':endDate', $this->endDate, PDO::PARAM_STR);
        $insertArticle->bindValue(':stock', $this->stock, PDO::PARAM_INT);
        $insertArticle->bindValue(':idUsers', $this->idUsers, PDO::PARAM_INT);
        $insertArticle->bindValue(':idCategory', $this->idCategory, PDO::PARAM_INT);
        $insertArticle->bindValue(':idLocation', $this->idLocation, PDO::PARAM_INT);
        return $insertArticle->execute();
    }

}
