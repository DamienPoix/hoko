<?php
include_once '../class/path.php';
include_once path::getControllersPath() . 'parameterAccountCtl.php';
include_once path::getViewsPath() . 'header.php';
?>
<div class = "container">
    <h2 class="titleMod">Modification du profil</h2>
    <form class ="col s12" method ="POST" action ="#" id ="formParameterChange">
        <fieldset class="white border">
            <legend>Informations personnelles</legend>
            <div class = "row">
                <div class = "input-field col s12 m6">
                    <i class = "material-icons prefix">face</i>
                    <input id = "lastname" type = "text" class = "validate" name = "lastname" value="<?= $_SESSION['lastname'] ?>" />
                    <label for = "lastname">Nom</label>
                    <p class = "error"><?= isset($formError['lastname'])? $formError['lastname'] : '' ?></p>
                </div>
                <div class = "input-field col s12 m6">
                    <i class = "material-icons prefix">face</i>
                    <input id = "firstname" type = "text" class = "validate" name = "firstname" value="<?= $_SESSION['firstname'] ?>" />
                    <label for = "firstname">Prénom</label>
                    <p class = "error"><?= isset($formError['firstname'])? $formError['firstname'] : '' ?></p>
                </div>
            </div>
            <div class = "row">
                <div class = "input-field col  s12 m6">
                    <i class = "material-icons prefix">people</i>
                    <select name = "civility">
                        <option value = "0" disabled selected>Civilité</option>
                        <?php
                        foreach ($showCivility as $civility) {
                            ?>
                            <option value="<?= $civility->id ?>"<?= $_SESSION['idCivility'] == $civility->id ? 'selected' : '' ?>><?= $civility->civility ?></option>
                        <?php } ?>
                    </select>
                    <label>Civilite</label>
                    <p class="error"></p>
                </div>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">cake</i>
                    <input type="date" id="birthdate" name="birthdate" placeholder="" value="<?= $_SESSION['birthdate'] ?>" />
                    <label for="birthdate"> Date de naissance </label>
                    <p class="error"><?= isset($formError['birthdate'])? $formError['birthdate'] : '' ?></p>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">contact_mail</i>
                    <input id="mail" type="text" class="validate" name="mail" value="<?= $_SESSION['mail'] ?>" />
                    <label for="mail">Mail </label>
                    <p class="error"><?= isset($formError['mail'])? $formError['mail'] : '' ?></p>
                </div>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">contact_phone</i>
                    <input  id="phone" type="text" class="validate" name="phone" value="<?= $_SESSION['phone'] ?>" />
                    <label for="phone">Téléphone</label>
                    <p class="error"><?= isset($formError['phone'])? $formError['phone'] : '' ?></p>
                </div>
            </div>
        </fieldset>
        <fieldset class="white">
            <legend>Informations de compte</legend>
            <select name="userType">
                <option value="0" disabled selected>Type de compte</option> 
                <?php
                foreach ($showType as $type) {
                    ?>
                    <option value="<?= $type->id ?>"<?= $_SESSION['idUserType'] == $type->id ? 'selected' : '' ?>><?= $type->name ?></option>
                <?php } ?>
            </select>     
        </fieldset>
        <input type="submit" name="submit" id="submit" value="modification du profil" class="btn green darken-4 col s12 m3"/>
    </form>
    <!-- Modal Trigger -->
    <a class="btn waves-effect waves-light modal-trigger red darken-4" href="#modalSuppr" id="right">Supprimer l'utilisateur</a>
    <!-- Modal Structure -->
    <div id="modalSuppr" class="modal">
        <div class="modal-content">
            <h4 class="centerText titleMod">Suppresion du profil</h4>
            <p  class="centerText boldText">Voulez-vous vraiment supprimer votre profil</p>
            <p class="centerText"><a href="Parameter?idDelete=<?= $_SESSION['id'] ?>" class="modal-close waves-effect waves-light btn-flat red white-text boldText ">Supprimer</a></p>
            <a href="Parameter" class="modal-close waves-effect waves-light btn-flat green white-text boldText floatR">Annuler</a> 
        </div>
    </div>
    <?php
    include_once path::getViewsPath() . 'footer.php';
    ?>