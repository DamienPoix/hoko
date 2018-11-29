<?php
include_once path::getModelsPath() . 'article.php';

$info = NEW articles();
//
if (isset($_GET['Article']) && is_numeric($_GET['Article'])) {
    $info->id = htmlspecialchars($_GET['Article']);
}
$articleInfo = $info->moreInfo();