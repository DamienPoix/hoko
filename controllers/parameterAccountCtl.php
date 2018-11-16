<?php

//include des models
include_once path::getModelsPath() . 'userTypes.php';
include_once path::getModelsPath() . 'civility.php';
include_once path::getModelsPath() . 'user.php';
//déclaration des regex pour la vérification !
$regexBirthDate = '/^(([1][9][2-9][0-9])|([2][0][0][0-9])|([2][0][1][0-8]))-(([0][\d])|([1][0-2]))-(([0-2][\d])|([3][0-1]))$/';
$regexUsername = '/^[a-zA-Z0-9àáâãäåéèêëîïìíØøòóôõöùúûüýÿñçßæœ_\'\-]{1,25}$/';
$regexName = '/^[A-Za-zàèìòùÀÈÌÒÙáéíóúýÁÉÍÓÚÝâêîôûÂÊÎÔÛãñõÃÑÕäëïöüÿÄËÏÖÜŸçÇßØøÅåÆæœ° \'\-]+$/';
$regexMail = '/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/';
$regexId = '/[0-9]+/';
$regexPhone = '/^[0][1-9][0-9]{8}$/';
//intanciation de civility
$getCivility = NEW civility();
$showCivility = $getCivility->showCivility();
//intanciation de UserType
$getUserType = NEW userType();
$showType = $getUserType->showType();
$formError = array();
//partie pour le formulaire de modification
if (isset($_POST['submit'])) {
    session_start();
    $changeContent = new users();
    //
    $changeContent->id = $_SESSION['id'];
    $changeContent->username = $_SESSION['username'];
    $changeContent->createDate = $_SESSION['createDate'];
    $changeContent->password = $_SESSION['password'];
    //
    //vérification pour le lastname
    if (!empty($_POST['lastname'])) {
        $lastname = $_POST['lastname'];
        if (preg_match($regexName, $lastname)) {
            $changeContent->lastname = htmlspecialchars($_POST['lastname']);
        } else {
            
        }
    } else {
        
    }
    //vérification pour le firstname
    if (!empty($_POST['firstname'])) {
        $firstname = $_POST['firstname'];
        if (preg_match($regexName, $firstname)) {
            $changeContent->firstname = htmlspecialchars($_POST['firstname']);
        } else {
            
        }
    } else {
        
    }


    //vérification pour le mail
   /* vérification que le champ mail n'est pas vide et 
     * vérification de la validité du mail avec un filtre puis
     * attribution de sa valeur à l'attribut mail de l'objet $user avec la sécurité htmlspecialchars (évite injection de code)
     */
    if (!empty($_POST['mail']) && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        $changeContent->mail = htmlspecialchars($_POST['mail']);
        //si le champ est vide ou s'il n'est pas valide affichage d'un message d'erreur
    } else {
        $formError['mail'] = 'Veuillez indiquer votre mail';
    } 
    //vérification pour le numéro de téléphone
    if (!empty($_POST['phone'])) {
        $phone = $_POST['phone'];
        if (preg_match($regexPhone, $phone)) {
            $changeContent->phone = htmlspecialchars($_POST['phone']);
        } else {
            
        }
    } else {
        
    }
    //vérification que le champ birthDate n'est pas vide 
    if (!empty($_POST['birthdate'])) {
        //vérification de la validité de la valeur et attribution de cette valeur à l'attribut birthDate de l'objet $user avec la sécurité htmlspecialchars (évite injection de code)
        if (preg_match($regexBirthDate, $_POST['birthdate'])) {
            $changeContent->birthdate = htmlspecialchars($_POST['birthdate']);
            //si la valeur n'est pas valide affichage d'un message d'erreur
        } else {
            $formError['birthdate'] = 'La saisie de votre date de naissance est invalide';
        }
        //si le champ est vide affichage d'un message d'erreur
    } else {
        $formError['birthdate'] = 'Veuillez indiquer votre date de naissance';
    }
    //vérification pour le userType
    if (!empty($_POST['userType'])) {
        $changeContent->idUserType = htmlspecialchars($_POST['userType']);
    } else {
        
    }
    //vérification pour le civility
    if (!empty($_POST['civility'])) {
        $changeContent->idCivility = htmlspecialchars($_POST['civility']);
    } else {
        
    }
    if (count($formError) == 0) {
        //affichage d'un message d'erreur si la méthode ne s'exécute pas
        if (!$changeContent->updateUserContent()) {
            $formError['updateUserSubmit'] = 'Il y a eu un problème veuillez contacter l\'administrateur du site';
        } else {
            $_SESSION['lastname'] = $changeContent->lastname;
            $_SESSION['firstname'] = $changeContent->firstname;
            $_SESSION['mail'] = $changeContent->mail;
            $_SESSION['phone'] = $changeContent->phone;
            $_SESSION['birthdate'] = $changeContent->birthdate;
            $_SESSION['userType'] = $changeContent->idUserType;
            $_SESSION['civility'] = $changeContent->idCivility;
        }
    }
    session_write_close();
}
//suppresion de l'utilisateur
if (isset($_GET['idDelete'])) {
//instanciation pour la suppression
    $delete = NEW users();
    $delete->id = htmlspecialchars($_GET['idDelete']);
//appel de la méthode deleteUser() permettant la suppression d'un utilisateur
    $deleteUser = $delete->deleteUser();
//si la méthode s'exécute 
    if ($deleteUser == TRUE) {
        //ouverture de la session
        session_start();
        //destruction de la session
        session_destroy();
        //redirection vers la page d'inscription
        header('Location: home');
        exit();
        //affichage d'un message d'erreur si la requête ne s'est pas exécutée
    } elseif ($deleteUser === FALSE) {
        $deleteError = 'L\'utilisateur n\'a pas pu être supprimé, veuillez contacter l\'administrateur du site';
    }
}
