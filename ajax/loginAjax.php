<?php
session_start();

include_once '../class/path.php';
include_once path::getModelsPath() . 'user.php';
$success = false;
//déclaration de la variable $errorMessage a false 
$errorMessage = false;
//nous faisons les diverse vérification pour savoir si les champs sont vide etc..
if (!empty($_POST['usernameConnexion'])) {
    $username = htmlspecialchars($_POST['usernameConnexion']);
} else {
//si il y a une erreur on initie a true
    $errorMessage = true;
}
if (!empty($_POST['passwordConnexion'])) {
    $password = htmlspecialchars($_POST['passwordConnexion']);
} else {
//si il y a une erreur on initie a true
    $errorMessage = true;
}

if ($errorMessage == false) {
    $user = new users();
    $user->username = $username;
    if ($user->userConnect()) {
        if (password_verify($password, $user->password)) {
        //On rempli la session avec les attributs de l'objet issus de l'hydratation
              $_SESSION['username'] = $user->username;
            $_SESSION['lastname'] = $user->lastname;
            $_SESSION['firstname'] = $user->firstname;
            $_SESSION['birthdate'] = $user->birthdate;
            $_SESSION['mail'] = $user->mail;
            $_SESSION['phone'] = $user->phone;
            $_SESSION['idUserType'] = $user->idUserType;
            $_SESSION['idCivility'] = $user->idCivility;
            $_SESSION['createDate'] = $user->createDate;
            $_SESSION['id'] = $user->id;
            $_SESSION['password'] = $user->password;
            $_SESSION['isConnect'] = true;
            $success = true;
        } else {
            $errorMessage = true;
        }
    }
}
echo json_encode(array('errorMessage' => $errorMessage, 'success' => $success));