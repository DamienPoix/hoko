<?php

include_once '../class/path.php';
include_once path::getModelsPath() . 'user.php';
//déclaration des regex pour les inputs des formulaires de connexion et d'inscription
//déclaration de le regex birthdate 
//$regexBirthDate = '/^(([0-2][\d])|([3][0-1]))\/(([0][\d])|([1][0-2]))\/(([1][9][2-9][0-9])|([2][0]([0][0-9])|([1][0-8])))$/';
$regexBirthDate = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}/';
//
$regexName = '/^[a-zA-Z0-9àáâãäåéèêëîïìíØøòóôõöùúûüýÿñçßæœ_\'\-]{1,25}$/';
//
$formError = array();
$success = 0;
$user = new users();
//vérification pour le champ lastname
//
if (!empty($_POST['lastname'])) {
    $user->lastname = htmlspecialchars($_POST['lastname']);
} else {
    $formError['lastname'] = 'Merci de remplire le champ Nom correctement';
}
//vérification pour le champ firstname
if (!empty($_POST['firstname'])) {
    $user->firstname = htmlspecialchars($_POST['firstname']);
} else {
    $formError['firstname'] = 'Merci de remplire le champ Prénom correctement';
}
//vérification pour le select civility
if (!empty($_POST['idCivility'])) {
    $user->idCivility = htmlspecialchars($_POST['idCivility']);
} else {
    $formError['idCivility'] = 'Merci de remplire le champ civilité correctement';
}
//vérification pour le champ birthdate
if (!empty($_POST['birthdate'])) {
    if (preg_match($regexBirthDate, $_POST['birthdate'])) {
        $user->birthdate = htmlspecialchars($_POST['birthdate']);
    } else {
        //vérification si la date de naissance est valide
        $formError['birthdate'] = 'Merci d\'utiliser un age valide';
    }
} else {
    $formError['birthdate'] = 'Merci de remplire le champ birthdate correctement';
}
//vérification pour le champ mail
if (!empty($_POST['mail'])) {
    $user->mail = htmlspecialchars($_POST['mail']);
} else {
    $formError['mail'] = 'Merci de remplire le champ mail correctement';
}
//vérification pour le champ phone
if (!empty($_POST['phone'])) {
    $user->phone = htmlspecialchars($_POST['phone']);
} else {
    $formError['phone'] = 'Merci de remplire le champ phone correctement';
}
//vérification pour le champ username
if (!empty($_POST['username'])) {
    if (preg_match($regexName, $_POST['username'])) {
        $user->username = htmlspecialchars($_POST['username']);
    } else {
        $formError['username'] = 'Merci d\'utilisé un username valide(caractère maximale)';
    }
} else {
    $formError['username'] = 'Merci de remplir le champ téléphone correctement';
}
//vérification pour le champ password
if (!empty($_POST['password'])) {
    $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
} else {
    $formError['password'] = '';
}
//vérification pour le champ phone
if (!empty($_POST['userType'])) {
    $user->idUserType = htmlspecialchars($_POST['userType']);
} else {
    $formError['userType'] = 'Merci de remplir le champ userType correctement';
}
//appel de la méthode vérifiant la disponibilité du nom d'utilisateur
    $checkUsername = $user->checkIfUserExist();
//s'il n'y a pas d'erreur on appelle la méthode pour l'ajout d'un utilisateur
if (count($formError) == 0) {
    $user->createDate = date('Y-m-d');   
    //si la méthode retourne 0 le nom d'utilisateur est disponible et l'utilisateur peut être ajouté à la base de données
    if ($checkUsername === '0') {
        //affichage d'un message d'erreur si la méthode ne s'exécute pas
        if (!$user->addUser()) {
            $formError['registerContributorSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
        }
        //si la méthode retourne false affichage d'un message d'erreur car la requête ne s'est pas exécutée correctement
    } elseif ($checkUsername === FALSE) {
        $formError['registerContributorSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
        //sinon la méthode retourne 1, le nom d'utilisateur n'est pas disponible, affichage d'un message d'erreur
    } else {
        //si tout est bon on envoie 1
        
        $formError['username'] = 'Ce nom d\'utilisateur est déjà utilisé';
    }
    $success = 1;
}
echo json_encode(array('success' => $success, 'formError' => $formError));
