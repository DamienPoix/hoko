<?php
include_once path::getModelsPath() . 'user.php';

$profilUser = NEW users();
//
if (isset($_GET['id'])) {
    $profilUser->id = $_GET['id'];
}
$user = $profilUser->getProfilUser();