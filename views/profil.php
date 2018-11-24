<?php
include_once '../class/path.php';
include_once path::getControllersPath() . 'profilCtl.php';
session_start();
if(isset($_SESSION['isConnect']) && $_SESSION['isConnect'] == true){
session_write_close();
include_once path::getViewsPath() . 'header.php';
$identityName =$_SESSION['lastname'] . ' ' . $_SESSION['firstname'];
?>
<div class="row">
    <div class="profilImg">
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
        <div class="profilInfo">
            <p class="identityName"><?= $identityName ?></p>
            <p class="phoneStyle">téléphone : <?= $_SESSION['phone'] ?></p>
            <p class="mailStyle">mail : <?= $_SESSION['mail'] ?></p>
        </div>
        <div class="profilInfo">
            <p class="memberDate">Membre depuis le : <?= $_SESSION['createDate'] ?></p> 
        </div>
    </div>
    <?php
    include_once path::getViewsPath() . 'footer.php';
} else {
    header('location: home');
    exit;
}
    ?>