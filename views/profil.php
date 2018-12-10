<?php
include_once '../class/path.php';
include_once path::getControllersPath() . 'profilCtl.php';
session_start();
if (isset($_SESSION['isConnect']) && $_SESSION['isConnect'] == true) {
    session_write_close();
    include_once path::getViewsPath() . 'header.php';
    $identityName = $_SESSION['lastname'] . ' ' . $_SESSION['firstname'];
    ?>
    <div class="row">
        <div class="col s12 m2">
            <div class="profilImg white">
                <form name="uploadImage" id="uploadImage" method="POST" enctype="multipart/form-data">
                    <div class="errorProfil hidden"></div>
                    <div class="relative">
                        <input id="userImage" class="hidden" type="file" name="userImage" accept="image/png" />
                        <label for="userImage">
                            <img id="userImageDisplayed" class="userImg"  src="../assets/IMG/userImage/<?= $_SESSION['id'] ?>" title="user image" alt="user image" onerror="this.src='../assets/IMG/userImage/profil.png'" onabort="this.src='../assets/IMG/userImage/profil.png'" /> 
                        </label>
                    </div>
                    <input name="id" type="hidden" value="<?= $_SESSION['id'] ?>"/>
                </form>
                <p class="usernameStyle"><?= $_SESSION['username'] ?></p>
            </div>
        </div>
        <div class="col s12 m9 offset-m1 profilInfo white">
            <p class="identityName"><?= $identityName ?></p>
            <p class="phoneStyle">téléphone : <?= $_SESSION['phone'] ?></p>
            <p class="mailStyle">mail : <?= $_SESSION['mail'] ?></p>
        </div>
        <div class="row">
            <div class=" col s12 m12 profilInfo white">
                <p class="memberDate">Membre depuis le : <?= $_SESSION['createDate'] ?></p> 
            </div>
        </div>
    </div>
    <?php
    if (isset($success)) {
        if ($success == true) {
            ?>
            <p class="success"> La supresion de votre article a été valider </p>
        <?php } else { ?>
            <p class="allError centerText"> suppression impossible un problème est survenue </p>
            <?php
        }
    }
    foreach ($showArticle as $a) {
        ?>
        <div class="container">
            <div class="row border white">
                <div class="col s6 m2">
                    <p>Titre : <?= $a->name ?></p>
                </div>
                <div class="col s6 m2 offset-m1">
                    <p>Prix : <?= $a->price ?> €</p>
                </div>
                <div class="col s12 m2 offset-m1">
                    <p>date d'ajout : <?= $a->postDate ?></p>
                </div>
                <div class="col s6 m1 offset-m2">
                    <a class="btn-floating btn-large pulse green right"><i class="material-icons">create</i></a>
                </div>
                <div class="col s6 m1">
                    <a class="btn-floating btn-large pulse red modal-trigger" href="#modalArticleSuppr"><i class="material-icons">delete</i></a>
                </div>
            </div>
            <div id="modalArticleSuppr" class="modal">
                <div class="modal-content">
                    <h4 class="centerText titleMod">Suppresion</h4>
                    <p  class="centerText boldText">Voulez-vous vraiment supprimer cette Article</p>
                    <p class="centerText"><a href="Profil?ArticleIdDelete=<?= $a->id ?>" class="modal-close waves-effect waves-light btn-flat red white-text boldText ">Supprimer</a></p>
                    <a href="Profil" class="modal-close waves-effect waves-light btn-flat green white-text boldText floatR">Annuler</a> 
                </div>
            </div>
        </div>
        <?php
    }
    include_once path::getViewsPath() . 'footer.php';
} else {
    header('location: home');
    exit;
}
?>