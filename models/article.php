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
        $request = 'INSERT INTO `p24oi86_article`(`name`,`description`,`price`,`postDate`,`endDate`,`idUsers`,`idCategory`,`idLocation`) '
                . 'VALUES (:name, :description, :price,:postDate, :endDate, :idUsers, :idCategory, :idLocation)';
        $insertArticle = $this->db->prepare($request);
        //        blind value permet de mettre une valeur a notre marqueur nominatif, il nous protége un minimum des injection sql
        //        on utilise un bind value pour chaque clé nominatif
        $insertArticle->bindValue(':name', $this->name, PDO::PARAM_STR);
        $insertArticle->bindValue(':description', $this->description, PDO::PARAM_STR);
        $insertArticle->bindValue(':price', $this->price, PDO::PARAM_INT);
        $insertArticle->bindValue(':postDate', $this->postDate, PDO::PARAM_STR);
        $insertArticle->bindValue(':endDate', $this->endDate, PDO::PARAM_STR);
        $insertArticle->bindValue(':idUsers', $this->idUsers, PDO::PARAM_INT);
        $insertArticle->bindValue(':idCategory', $this->idCategory, PDO::PARAM_INT);
        $insertArticle->bindValue(':idLocation', $this->idLocation, PDO::PARAM_INT);
        return $insertArticle->execute();
    }

    public function showArticle() {
        $request = 'SELECT `at`.`id`,'
                . ' `at`.`name`,'
                . ' `at`.`description`,'
                . '`at`.`price`,'
                . ' DATE_FORMAT(`at`.`postDate`, \'%d/%m/%Y\') AS `postDate`,'
                . ' DATE_FORMAT(`at`.`endDate`, \'%d/%m/%Y\') AS `endDate`,'
                . ' `at`.`idUsers`,'
                . '`at`.`idLocation`,'
                . '`at`.`idCategory`, '
                . '`cat`.`name` AS `category`, '
                . '`loc`.`department` '
                . 'FROM `p24oi86_article` AS `at`'
                . 'LEFT JOIN `p24oi86_category` AS `cat` ON `at`.`idCategory` = `cat`.`id` '
                . 'LEFT JOIN `p24oi86_location` AS `loc` ON `at`.`idLocation` = `loc`.`id` '
                . 'ORDER BY `at`.`id` DESC '
                . 'LIMIT 5' ;
        $articleInfo = $this->db->prepare($request);
        $articleInfo->execute();
        if (is_object($articleInfo)) {
            //récupération des infos de l'article
            $result = $articleInfo->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

    /**
     * methode pour compter le nombre d'article qu'il y a
     * @return type
     */
    public function countArticle() {
        $request = 'SELECT COUNT(`id`) AS `nbrArticle` FROM `p24oi86_article`';
        $articleCount = $this->db->query($request);
        $articleCountResult = $articleCount->fetch(PDO::FETCH_OBJ);
        return $articleCountResult;
    }

    public function showAll($limit, $limitStart) {
        $getArticleReturn = array();
        //OFFSET = IGNORÉ/decalage 
        $request = 'SELECT `at`.`id`,'
                . ' `at`.`name`,'
                . ' `at`.`description`,'
                . '`at`.`price`,'
                . ' DATE_FORMAT(`at`.`postDate`, \'%d/%m/%Y\') AS `postDate`,'
                . ' DATE_FORMAT(`at`.`endDate`, \'%d/%m/%Y\') AS `endDate`,'
                . ' `at`.`idUsers`,'
                . '`at`.`idLocation`,'
                . '`at`.`idCategory`, '
                . '`cat`.`name` AS `category`, '
                . '`loc`.`department` '
                . 'FROM `p24oi86_article` AS `at`'
                . 'LEFT JOIN `p24oi86_category` AS `cat` ON `at`.`idCategory` = `cat`.`id` '
                . 'LEFT JOIN `p24oi86_location` AS `loc` ON `at`.`idLocation` = `loc`.`id` '
                . 'LIMIT :limit OFFSET :limitStart';
        $allArticle = $this->db->prepare($request);
        $allArticle->bindValue(':limit', $limit, PDO::PARAM_INT);
        $allArticle->bindValue(':limitStart', $limitStart, PDO::PARAM_INT);
        if ($allArticle->execute()) {
            $getArticleReturn = $allArticle->fetchAll(PDO::FETCH_OBJ);
        } else {
            $getArticleReturn = false;
        }
        return $getArticleReturn;
    }
    public function moreInfo() {
        $request =  'SELECT `at`.`id`,'
                . ' `at`.`name`,'
                . ' `at`.`description`,'
                . '`at`.`price`,'
                . ' DATE_FORMAT(`at`.`postDate`, \'%d/%m/%Y\') AS `postDate`,'
                . ' DATE_FORMAT(`at`.`endDate`, \'%d/%m/%Y\') AS `endDate`,'
                . ' DATE_FORMAT(`us`.`createDate`, \'%d/%m/%Y\') AS `createDate`,'
                . ' `at`.`idUsers`,'
                . '`at`.`idLocation`,'
                . '`at`.`idCategory`, '
                . '`cat`.`name` AS `category`, '
                . '`loc`.`department`, '
                . '`us`.`username`, '
                . '`us`.`mail` '
                . 'FROM `p24oi86_article` AS `at`'
                . 'LEFT JOIN `p24oi86_category` AS `cat` ON `at`.`idCategory` = `cat`.`id` '
                . 'LEFT JOIN `p24oi86_location` AS `loc` ON `at`.`idLocation` = `loc`.`id` '
                . 'LEFT JOIN `p24oi86_users` AS `us` ON `at`.`idUsers` = `us`.`id` '
                . 'WHERE `at`.`id` = :id';
        $info = $this->db->prepare($request);
        $info->bindValue('id', $this->id, PDO::PARAM_INT);
        if($info->execute()){
            $returnInfo = $info->fetch(PDO::FETCH_OBJ);
        } else {
            $returnInfo = false;
        }
        return $returnInfo;
    }
    public function showArticleInProfil(){
        $request = 'SELECT `id` ,`name`,DATE_FORMAT(`postDate`, \'%d/%m/%Y\') AS `postDate`, `price` '
                . 'FROM `p24oi86_article` '
                . 'WHERE `idUsers` = :idUsers';
        $articleInProfil = $this->db->prepare($request);
        $articleInProfil->bindValue(':idUsers', $this->idUsers, PDO::PARAM_INT);
         if($articleInProfil->execute()){
            $returnArticleInProfil = $articleInProfil->fetchAll(PDO::FETCH_OBJ);
        } else {
            $returnArticleInProfil = false;
        }
        return $returnArticleInProfil;
    }
}
