<?php

//include de la database
include_once path::getClassesPath() . 'database.php';
/**
 * Création de la class articles héritière de database
 */
class articles extends database {

    //déclaration des attributs
    public $id; //id de l'article
    public $name; //nom de l'article
    public $description; //description de l'article
    public $price; //prix de l'article
    public $postDate; //date de l'ajout de l'article
    public $endDate; //date de fin pour l'articles si il y en a une
    public $stock; //stock d'objet disponible (pour les utilisateur professionnel)
    public $idUsers; //id de l'utilisateur qui ajoute l'article
    public $idCategory; //id de la catégorie sélectionner par l'utilisateur
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
    /**
     * Méthode pour afficher les 5 dernier articles (page index)
     */
    public function showArticle() {
        //déclaration de la requête sql
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
                . 'LIMIT 5';
          //appel de la requête avec un query que l'on stocke dans l'objet $articleInfo
        $articleInfo = $this->db->query($request);
        $articleInfo->execute();
          //on vérifie que $articleInfo est un objet
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
        //déclaration de la requete sql
        $request = 'SELECT COUNT(`id`) AS `nbrArticle` FROM `p24oi86_article`';
        //appel de la requête avec un query que l'on stocke dans l'objet PDO $articleCount
        $articleCount = $this->db->query($request);
        $articleCountResult = $articleCount->fetch(PDO::FETCH_OBJ);
        return $articleCountResult;
    }
      /**
     * Méthode permettant la pagination pour l'affichage des lieux
     * @param type $limit
     * @param type $limitStart
     * @return boolean
     */
    public function showAll($limit, $limitStart) {
        //initialisation d'un tableau vide
        $getArticleReturn = array();
        //OFFSET = IGNORÉ/decalage 
          //déclaration de la requête sql
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
         //appel de la requête avec un prepare (car il y a des marqueurs nominatifs) que l'on stocke dans l'objet $allArticle
        $allArticle = $this->db->prepare($request);
          //attribution des valeurs aux marqueurs nominatifs avec bindValue (protection contre les injections de sql)
        $allArticle->bindValue(':limit', $limit, PDO::PARAM_INT);
        $allArticle->bindValue(':limitStart', $limitStart, PDO::PARAM_INT);
           //vérification que la requête s'est bien exécutée
        if ($allArticle->execute()) {
            $getArticleReturn = $allArticle->fetchAll(PDO::FETCH_OBJ);
        } else {
            $getArticleReturn = false;
        }
        return $getArticleReturn;
    }
     /**
     * Méthode pour afficher plus d'information sur l'objet sélectionner
     */
    public function moreInfo() {
        //déclaration de la requete sql
        $request = 'SELECT `at`.`id`,'
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
           //appel de la requête avec un prepare (car il y a des marqueurs nominatifs) que l'on stocke dans l'objet $info
        $info = $this->db->prepare($request);
        //attribution des valeurs aux marqueurs nominatifs avec bindValue (protection contre les injections de sql)
        $info->bindValue('id', $this->id, PDO::PARAM_INT);
        //vérification que la requete s'execute correctement
        if ($info->execute()) {
            $returnInfo = $info->fetch(PDO::FETCH_OBJ);
        } else {
            $returnInfo = false;
        }
        return $returnInfo;
    }
    /**
     * Méthode pour afficher les articles mis en ligne par l'utilisateur(peu d'information)
     */
    public function showArticleInProfil() {
        //déclaration de la requete sql
        $request = 'SELECT `id` ,`name`,DATE_FORMAT(`postDate`, \'%d/%m/%Y\') AS `postDate`, `price` '
                . 'FROM `p24oi86_article` '
                . 'WHERE `idUsers` = :idUsers';
            //appel de la requête avec un prepare (car il y a des marqueurs nominatifs) que l'on stocke dans l'objet $articleInProfil
        $articleInProfil = $this->db->prepare($request);
          //attribution des valeurs aux marqueurs nominatifs avec bindValue (protection contre les injections de sql)
        $articleInProfil->bindValue(':idUsers', $this->idUsers, PDO::PARAM_INT);
        //vérification que la requete s'execute correctement
        if ($articleInProfil->execute()) {
            $returnArticleInProfil = $articleInProfil->fetchAll(PDO::FETCH_OBJ);
        } else {
            $returnArticleInProfil = false;
        }
        return $returnArticleInProfil;
    }
    /**
     * Méthode pour afficher plus d'information sur l'objet sélectionner
     */
    public function SupprArticle() {
        //déclaration de la requete sql
        $request = 'DELETE FROM `p24oi86_article`'
                . 'WHERE `id` = :id';
            //appel de la requête avec un prepare (car il y a des marqueurs nominatifs) que l'on stocke dans l'objet $delete
        $delete = $this->db->prepare($request);
          //attribution des valeurs aux marqueurs nominatifs avec bindValue (protection contre les injections de sql)
        $delete->bindValue(':id', $this->id, PDO::PARAM_INT);
        //vérification que la requête s'est bien exécutée
        if ($delete->execute()) {
            //vérification qu'il s'agit bien d'un objet
            if (is_object($delete)) {
                return $delete;
            }
        }
    }

}
