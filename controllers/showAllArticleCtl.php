<?php
include_once path::getModelsPath().'article.php';

$limit = 5;
//instanciation de article pour l'affichage des article/pagination
$article = new articles();
//appel de la méthode countArticle indiquant le nombre d'article
$resultNumberArticle = $article->countArticle();
//calcul du nombre de page
//ceil permet d'arrondir au nombre entier suppérieur
$totalPage = ceil($resultNumberArticle->nbrArticle / $limit);
//vérification de la présence de "page" dans l'url et qu'il n'est pas vide
if (!empty($_GET['page'])) {
    //si ce n'est pas un nombre ou qu'il est supérieur au nombre total de page ou qu'il est inférieur à 0, attribution de la valeur 1 à la variable $page
    if (!is_numeric($_GET['page']) || $_GET['page'] > $totalPage || $_GET['page'] <= 0) {
        $page = 1;
    } else { //si tout va bien attribution de la valeur de la page à la variable $page
        $page = $_GET['page'];
    }
} else { //si $_get['page'] est vide alors on lui attribut la valeur 1
    $page = 1;
}
//calcul du premier élément de chaque page (on calcule le nombre de resultat qu'on ne prend pas en compte)
$limitStart = ($page - 1) * $limit;
//on appel la méthode showAll qui prend comme parametre $limit et $limitStart
$showArticle = $article->showAll($limit, $limitStart);