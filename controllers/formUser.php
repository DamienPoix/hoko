<?php
include_once path::getModelsPath() . 'user.php';    
include_once path::getModelsPath() . 'userTypes.php';
include_once path::getModelsPath() . 'civility.php';
//intanciation de civility
$getCivility = NEW civility();
$showCivility = $getCivility->showCivility();
//intanciation de UserType
$getUserType = NEW userType();
$showType = $getUserType->showType();
//instaciation de l'user
$profilUser = NEW users();
//c'est ici
if (isset($_GET['id'])) {
    $profilUser->id = htmlspecialchars($_GET['id']);
}
$userProfile = $profilUser->getProfilUser();
