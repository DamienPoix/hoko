<?php
include_once '../class/path.php';
include_once path::getControllersPath() . 'parameterAccountCtl.php';
include_once path::getViewsPath() . 'header.php';
?>
<div class = "container">
    <form class = "col s12" method = "POST" action = "#" id = "formRegister">
        <fieldset>
            <legend>Informations personnelles</legend>
            <div class = "row">
                <div class = "input-field col s12 m6">
                    <i class = "material-icons prefix">face</i>
                    <input id = "lastname" type = "text" class = "validate" name = "lastname" value="<?= $_SESSION['lastname'] ?>" />
                    <label for = "lastname">Prénom</label>
                    <p class = "error"></p>
                </div>
                <div class = "input-field col s12 m6">
                    <i class = "material-icons prefix">face</i>
                    <input id = "firstname" type = "text" class = "validate" name = "firstname" value="<?= $_SESSION['firstname'] ?>" />
                    <label for = "firstname">Nom</label>
                    <p class = "error"></p>
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
                    <p class="error"></p>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">contact_mail</i>
                    <input id="mail" type="text" class="validate" name="mail" value="<?= $_SESSION['mail'] ?>" />
                    <label for="mail">Mail </label>
                    <p class="error"></p>
                </div>
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">contact_phone</i>
                    <input  id="phone" type="text" class="validate" name="phone" value="<?= $_SESSION['phone'] ?>" />
                    <label for="phone">Téléphone</label>
                    <p class="error"></p>
                </div>
            </div>
        </fieldset>
        <fieldset>
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
    <a class="btn waves-effect waves-light modal-trigger red darken-4" href="#modalSuppr">Supprimé le profil</a>
    <!-- Modal Structure -->
    <div id="modalSuppr" class="modal">
        <div class="modal-content">
            <h4>Voulez-vous vraiment supprimé votre profil</h4>
        </div>
        <div class="modal-footer">
            <div class="row">
                <div class="left text-lighten-4">
            <a href="Parameter?idDelete=<?= $_SESSION['id'] ?>" class="modal-close waves-effect waves-red btn-flat red darken-4 ">supprimé</a>
                </div>
                <div class="right">
            <a href="Parameter" class="modal-close waves-effect waves-green btn-flat green darken-4 text-light">annulé</a> 
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once path::getViewsPath() . 'footer.php';
?>