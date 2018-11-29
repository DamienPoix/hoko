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
session_write_close();