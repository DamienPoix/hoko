<?php

session_start();
//include du model pour les articles
include_once path::getModelsPath() . 'article.php';
//include du model pour les catégories
include_once path::getModelsPath() . 'category.php';
//include du model pour les catégories
include_once path::getModelsPath() . 'location.php';
//include du model pour les photos
include_once path::getModelsPath() . 'articlePicture.php';
//instanciation des catégory pour l'afficher dans la vues
$getCategory = new category();
$showCategory = $getCategory->showCategory();
//instanciation des catégory pour l'afficher dans la vues
$getLocation = new location();
$showLocation = $getLocation->showLocation();
//instanciation pour l'article
$article = new articles();
//déclaration du tableau d'erreur
$articleError = array();
//déclaration de la variable articleSuccess 
$articleSuccess = false;
//déclaration des regex
$regexName = '/^[a-zA-Z0-9àáâãäåéèêëîïìíØøòóôõöùúûüýÿñçßæœ _\'\-]+$/';
$regexDesc = '/^[a-zA-Z0-9àáâãäåéèêëîïìíØøòóôõöùúûüýÿñçßæœ _\'\n\r-,;!:.@]+$/';
$regexNumber = '/[0-9]+/';
if (isset($_POST['submitArticle'])) {
    //déclaration de la variable date qu'on va utiliser pour la date de création et la durée de parution
    $date = date('Y-m-d G:m:s');
    //========- nom de l'article -========
    //vérification que le champ n'est pas vide
    if (!empty($_POST['articleName'])) {
        $name = $_POST['articleName'];
        //vérification que l'utilisateur n'utilise pas des caractères invalide
        if (preg_match($regexName, $name)) {
            $article->name = htmlspecialchars($name);
        } else {
            $articleError['articleName'] = 'Nom d\'article invalide (caractères invalide)';
        }
    } else {
        $articleError['articleName'] = 'Veuillez entrer un nom pour votre article';
    }
    //========- prix de l'article -========
    //vérification que le champ n'est pas vide
    if (!empty($_POST['price'])) {
        $price = $_POST['price'];
        //vérification que l'utilisateur n'utilise pas des caractères invalide
        if (preg_match($regexNumber, $price)) {
            $article->price = htmlspecialchars($price);
        } else {
            $articleError['articlePrice'] = 'Prix de l\'article invalide (caractères invalide)';
        }
    } else {
        $articleError['articlePrice'] = 'Veuillez mettre un prix a votre article';
    }
    //========- location de l'article -========
    if (!empty($_POST['location']) && $_POST['location'] != 0) {
        $location = $_POST['location'];
        //vérification que l'utilisateur n'utilise pas des caractères invalide
        if (preg_match($regexNumber, $location)) {
            $article->idLocation = htmlspecialchars($location);
        } else {
            $articleError['articleLocation'] = 'location de l\'article invalide (caractères invalide)';
        }
    }
    //========- category de l'article -========
    //vérification que le champ n'est pas vide
    if (!empty($_POST['category']) && $_POST['category'] != 0) {
        $category = $_POST['category'];
        //vérification que l'utilisateur n'utilise pas des caractères invalide
        $article->idCategory = htmlspecialchars($category);
    } else {
        $articleError['articleCategory'] = 'Veuillez sélectionner une catégorie pour votre article';
    }
    //========- temps de parution de  l'article -========
    //strtotime transforme une chaine de caractere en date
    if (!empty($_POST['endDate']) && $_POST['endDate'] != 0) {
        $endDate = $_POST['endDate'];
        if (preg_match($regexNumber, $endDate)) {
            if ($endDate == 1) {
                $endDate = date('Y-m-d G:m:s', strtotime($date . '+1 days'));
                $article->endDate = htmlspecialchars($endDate);
            } elseif ($endDate == 2) {
                $endDate = date('Y-m-d G:m:s', strtotime($date . '+7 days'));
                $article->endDate = htmlspecialchars($endDate);
            } elseif ($endDate == 3) {
                $endDate = date('Y-m-d G:m:s', strtotime($date . '+14 days'));
                $article->endDate = htmlspecialchars($endDate);
            } elseif ($endDate == 4) {
                $endDate = date('Y-m-d G:m:s', strtotime($date . '+1 month'));
                $article->endDate = htmlspecialchars($endDate);
            } else {
                $article->endDate = NULL;
            }
        } else {
            $articleError['endDate'] = 'Un problème est survenue avec le temps de parution de l\'article';
        }
    }
    //========-  description de  l'article -======== 
    if (!empty($_POST['descArticle'])) {
        $descArticle = $_POST['descArticle'];
        //vérification que l'utilisateur n'utilise pas des caractères invalide
        if (preg_match($regexDesc, $descArticle)) {
            $article->description = htmlspecialchars($descArticle);
        } else {
            $articleError['descArticle'] = 'description de l\'article invalide (caractères invalide)';
        }
    } else {
        $articleError['descArticle'] = 'Veuillez entrer une description';
    }
    //========- Finalisation -======== 
    if (count($articleError) == 0) {
        $article->postDate = $date;
        $article->idUsers = $_SESSION['id'];
        if (!$article->addArticle()) {
            
        }
        $articleSuccess = true;
    }
}
session_write_close();
