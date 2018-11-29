<?php
include_once path::getModelsPath() . 'article.php';

$showArticle = new articles();
$article = $showArticle->showArticle();
