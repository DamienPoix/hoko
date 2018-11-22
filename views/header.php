<?php
session_start();
include_once path::getControllersPath() . 'formUser.php';
include_once path::getControllersPath() . 'profilCtl.php';
?>
<!DOCTYPE html>
<html>
    <head>     
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/style.css" />
         <link href="https://fonts.googleapis.com/css?family=Acme" rel="stylesheet"> 
    </head>
    <body>
        <nav>
            <div class="nav-wrapper">
                <a href="home" class="brand-logo">HOKO</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                    <?php if (isset($_SESSION['isConnect']) == true) { ?>
                    <li><a class="btn orange darken-3" href="Ajout_Article">Ajouter un Article</a></li>
                        <li> <a href="#" class="waves-effect waves-dark btn dropdown-trigger" data-target='dropProfil' id="dropWidth"><?= $_SESSION['username'] ?></a></li>
                        <ul id='dropProfil' class='dropdown-content'>
                            <li><a href="Profil">Profil</a></li>
                            <li><a href="Parameter">Paramètres</a></li>
                            <li class="divider" tabindex="-1"></li>
                            <li><a href="disconnect">Déconnexion</a></li>
                        </ul>
                    <?php } else { ?>
                        <li><a class="btn orange darken-3" id="addArticleNotConnected">Ajouter un Article</a></li>
                        <li> <a href="#modalAccount" class="waves-effect waves-dark btn modal-trigger">Connexion/inscription</a></li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
        <ul class="sidenav" id="mobile-demo">
            <?php if (isset($_SESSION['isConnect']) == true) { ?>
                <li><a href="Profil"><?= $_SESSION['username'] ?></a></li>
                <li><a href="Parameter">Paramètres</a></li>
                <li><a href="disconnect">Déconnexion</a></li>
            <?php } else { ?>
                <li><a href="#modalAccount" class="waves-effect waves-dark btn modal-trigger"><i class="medium material-icons">account_box</i>Connexion/inscription</a></li>
            <?php } ?>
        </ul>
        <div id="modalAccount" class="modal">
            <div class="modal-content">
                <?php
                //formulaire de connection
                ?>
                <div id="connectForm">
                    <h4>Connexion</h4>
                    <div class="row">
                        <form class="col s12" method="POST" action="#" id="loginForm">
                            <div class="row">
                                <p id="errorMessage">Username ou mot de passe invalide!!</p>
                                <p id="errorNotConnect">Merci de vous connecter pour ajouter un article<p>
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">person_outline</i>
                                    <input type="text" id="usernameConnexion" class="autocomplete" name="usernameConnexion">
                                    <label for="usernameConnexion">Username</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">vpn_key</i>
                                    <input type="text" id="passwordConnexion"  name="passwordConnexion">
                                    <label for="passwordConnexion">mot de passe</label>
                                </div>
                                <input type="submit" class="btn" name="login" id="login" value="connexion"/>
                            </div>
                        </form>
                        <button class="btn formVisibilty">Inscription</button>
                    </div>
                </div>
                <?php // fin du formulaire pour se connecter   ?>
                <div id="registerForm">
                    <h4>Inscription</h4>
                    <div class="row">
                        <form class="col s12" method="POST" action="#" id="formRegister">
                            <fieldset>
                                <legend>Informations personnelles</legend>
                                <div class="row">
                                    <div class="input-field col s12 m6">
                                        <i class="material-icons prefix">face</i>
                                        <input id="lastname" type="text" class="validate" name="lastname">
                                        <label for="lastname">Nom </label>
                                        <p class="error"></p>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <i class="material-icons prefix">face</i>
                                        <input  id="firstname" type="text" class="validate" name="firstname">
                                        <label for="firstname">Prénom</label>
                                        <p class="error"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col  s12 m6">
                                        <i class="material-icons prefix">people</i>
                                        <select name="idCivility" id="idCivility">
                                            <option value="0" disabled selected>Civilité</option>
                                            <?php
                                            foreach ($showCivility as $civility) {
                                                ?>
                                                <option value="<?= $civility->id ?>"><?= $civility->civility ?></option>
                                            <?php } ?>
                                        </select>
                                        <label>Civilite</label>
                                        <p class="error"></p>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <i class="material-icons prefix">cake</i>
                                        <input type="date" id="birthdate" name="birthdate" placeholder=""/>
                                        <label for="birthdate"> Date de naissance </label>
                                        <p class="error"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m6">
                                        <i class="material-icons prefix">contact_mail</i>
                                        <input id="mail" type="text" class="validate" name="mail">
                                        <label for="mail">Mail </label>
                                        <p class="error"></p>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <i class="material-icons prefix">contact_phone</i>
                                        <input  id="phone" type="text" class="validate" name="phone">
                                        <label for="phone">Téléphone</label>
                                        <p class="error"></p>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>Informations de compte</legend>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">person_outline</i>
                                        <input  id="username" type="text" class="validate" name="username">
                                        <label for="username">Nom d'utilisateur</label>
                                        <p class="error"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m12">
                                        <i class="material-icons prefix">vpn_key</i>
                                        <input type="text" name="password" id="password" class="validate" required />
                                        <label for="password">Mot de passe </label>
                                        <p class="error"></p>
                                    </div>
                                </div>
                                <select name="userType" id="userType">
                                    <option value="0" disabled selected>Type de compte</option> 
                                    <?php
                                    foreach ($showType as $type) {
                                        ?>
                                        <option value="<?= $type->id ?>"><?= $type->name ?></option>
                                    <?php } ?>
                                </select>     
                            </fieldset>
                            <input type="submit" name="submit" id="submitRegister" value="inscription" class="btn"/>
                        </form>
                    </div>
                    <button class="formVisibilty" class="btn">Connexion</button>
                </div>
            </div>
        </div>
