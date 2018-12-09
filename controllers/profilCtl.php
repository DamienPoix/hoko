<?php
session_start();
include_once path::getModelsPath() . 'user.php';
include_once path::getModelsPath() . 'article.php';

$profilUser = NEW users();
$article = NEW articles();
//
if (isset($_GET['id'])) {
    $profilUser->id = $_GET['id'];
}
$user = $profilUser->getProfilUser();
//Affichage des articles
if(isset($_SESSION['id'])){    
$article->idUsers = $_SESSION['id'];
}
$showArticle = $article->showArticleInProfil();
//SUPPR d'un article par son id
//vérification de la présence de ArticleIdDelete
if(isset($_GET['ArticleIdDelete'])){
    //instanciation pour la suppression
    $delete = new articles();
    $delete->id = htmlspecialchars($_GET['ArticleIdDelete']);
    //appel de la methode supprArticle
    $deleteArticle = $delete->SupprArticle();
    //si la suppression se fais correctement on affiche un message de validation sinon on affiche un message d'erreur
    if($deleteArticle == true){
        //on affiche le message de validation
        $success = true;
    } else {
        //message d'erreur en cas de probléme
        $success = false;
    }
}
    
session_write_close();