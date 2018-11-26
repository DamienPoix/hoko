<?php
include_once '../class/path.php';
include_once path::getControllersPath() . 'addArticleCtl.php';
include_once path::getViewsPath() . 'header.php';
?>
<div class="container">
    <h2 class="centerText acme boldText">Ajout d'article</h2>
    <?php 
    if($articleSuccess == true){ ?>
    <p class="success boldText">Votre annonce a bien était sauvegarder vous allez être redirigé vers l'ajout de photo</p>
    <?php
        sleep(5);
        header('location: articlePictures');
        exit();
    } ?>
    <div class="row">
        <div class="col s12">
            <h3 class="centerText acme">Information principale</h3>
        </div>
    </div>
    <form action="#" method="POST" enctype="multipart/form-data" id="postArticle" name="postArticle">
        <div class="row">
            <?php
            if (isset($articleError['articleName'])) {
                ?><p class="allError"><?= $articleError['articleName'] ?></p>
            <?php }
            if (isset($articleError['price'])) {
                ?><p class="allError"><?= $articleError['price'] ?></p>
            <?php } ?>
            <div class="input-field col s12 m8">
                <i class="material-icons prefix">textsms</i>
                <label for="articleName">Titre de l'article</label>
                <input type="text" id="articleName" name="articleName" class="validate" />
            </div>
            <div class="input-field col s12 m4">
                <i class="material-icons prefix">attach_money</i>
                <label for="price">Prix</label>
                <input type="number" id="price" name="price" class="validate" />
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <h3 class="centerText acme">Information secondaire</h3>
            </div>
        </div>
        <?php
        if (isset($articleError['location'])) {
            ?><p class="allError"><?= $articleError['location'] ?></p>
        <?php } ?>
        <?php
        if (isset($articleError['category'])) {
            ?><p class="allError"><?= $articleError['category'] ?></p>
        <?php } ?>
        <?php
        if (isset($articleError['endDate'])) {
            ?><p class="allError"><?= $articleError['endDate'] ?></p>
        <?php } ?>
        <div class="row">
            <div class="col s12 m4">
                <select name="location" id="location">
                    <option value="0" disabled selected>location</option>
                    <?php
                    foreach ($showLocation as $location) {
                        ?>
                        <option value="<?= $location->id ?>"><?= $location->department ?></option> 
                    <?php } ?>
                </select>
            </div>
            <div class="col s12 m4">
                <select id="category" name="category">
                    <option value="0" disabled selected>category</option>
                    <?php
                    foreach ($showCategory as $category) {
                        ?>
                        <option value="<?= $category->id ?>"><?= $category->name ?></option> 
                    <?php } ?>
                </select>
            </div>
            <div class="col s12 m4">
                <select id="endDate" name="endDate">
                    <option value="0" disabled selected>Temps de parution</option>
                    <option value="1">1 jour</option>
                    <option value="2">7 jours</option>
                    <option value="3">14 jours</option>
                    <option value="4">1 mois</option>
                    <option value="5">indéfini</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <h3 class="centerText acme">Description de l'article</h3>
            </div>
        </div>
        <?php
        if (isset($formError['descArticle'])) {
            ?><p class="allError"><?= $formError['descArticle'] ?></p>
        <?php } ?>
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix">mode_edit</i>
                <textarea id="descArticle" name="descArticle" class="materialize-textarea validate" data-length="5000"></textarea>
                <label for="descArticle">Description de votre article</label>
            </div>
        </div>
<!--        <div class="row">
            <div class="col s12">
                <h3 class="centerText acme">Ajout de photo</h3>
            </div>
        </div>
        <div class="row">
            <div class="file-field input-field col s12 m2 offset-l1">
                <img id="articleImageDisplayed" class="articleImg z-depth-3" src="../assets/IMG/articleImage/adding.png">
                <input type="file" name="articlePicture1" id="articlePicture1" />
            </div>
            <div class="file-field input-field col s12 m2">
                <img id="articleImageDisplayed" class="articleImg z-depth-3" src="../assets/IMG/articleImage/adding.png">
                <input type="file" name="articlePicture2" id="articlePicture2" />
            </div>
            <div class="file-field input-field col s12 m2">
                <img id="articleImageDisplayed" class="articleImg z-depth-3" src="../assets/IMG/articleImage/adding.png">
                <input type="file" name="articlePicture3" id="articlePicture3" />
            </div>
            <div class="file-field input-field col s12 m2">
                <img id="articleImageDisplayed" class="articleImg z-depth-3" src="../assets/IMG/articleImage/adding.png">
                <input type="file" name="articlePicture4" id="articlePicture4" />
            </div>
            <div class="file-field input-field col s12 m2">
                <img id="articleImageDisplayed" class="articleImg z-depth-3" src="../assets/IMG/articleImage/adding.png">
                <input type="file" name="articlePicture5" id="articlePicture5" />
            </div>
        </div>-->
        <div class="row">
            <div class="col s12 m4 offset-m4">
                <input type="submit" class="btn orange darken-3 acme" id="submitArticle" name="submitArticle" value="ajouter l'article"/>
            </div>
        </div>
    </form>
</div>
<?php
include_once path::getViewsPath() . 'footer.php';
?>

