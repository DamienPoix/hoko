<?php
//include du model pour les articles
include_once path::getModelsPath().'article.php';
//include du model pour les catégories
include_once path::getModelsPath().'category.php';
//include du model pour les catégories
include_once path::getModelsPath().'location.php';
//include du model pour les photos
include_once path::getModelsPath().'articlePicture.php';
//instanciation des catégory pour l'afficher dans la vues
$getCategory = new category();
$showCategory = $getCategory->showCategory();
//instanciation des catégory pour l'afficher dans la vues
$getLocation = new location();
$showLocation = $getLocation->showLocation();
//instanciation pour l'article
$article = new articles();
