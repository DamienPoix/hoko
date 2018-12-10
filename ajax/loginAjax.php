<?php
//démarage de la session
session_start();
//insertion du fichier path  et du model user
include_once '../class/path.php';
include_once path::getModelsPath() . 'user.php';
//initialisation de la variable $success avec la valeur FALSE
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
        //instanciation de l'objet user
    $user = new users();
    $user->username = $username;
    if ($user->userConnect()) {
        //vérification que le mot de passe correspond à celui de l'utilisateur
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
            //si le mot de passe ne correspond pas, affichage du message d'erreur
            $errorMessage = true;
        }
    }
}
//lien vers l'ajax
echo json_encode(array('errorMessage' => $errorMessage, 'success' => $success));