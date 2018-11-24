<?php
include_once '../class/path.php';
include_once path::getViewsPath() . 'header.php';
include_once path::getControllersPath() . 'addArticleCtl.php';
?>
<div class="container">
    <h2 class="centerText">Ajout d'article</h2>
    <h3 class="centerText">Information principale</h3>
    <form action="#" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="input-field col s12 m8">
                <i class="material-icons prefix">textsms</i>
                <label for="articleName">Titre de l'article</label>
                <input type="text" id="articleName" name="articleName" class="validate"/>
            </div>
            <div class="input-field col s12 m4">
                <i class="material-icons prefix">attach_money</i>
                <label for="price">Prix</label>
                <input type="number" id="price" name="price" class="validate"/>
            </div>
        </div>
        <h3 class="centerText">Information secondaire</h3>
        <div class="row">
            <div class="col s12 m4">
                <select>
                    <option value="0" disabled selected>location</option>
                    <?php
                    foreach ($showLocation as $location) {
                        ?>
                        <option value="<?= $location->id ?>"><?= $location->department ?></option> 
                    <?php } ?>
                </select>
            </div>
            <div class="col s12 m4">
                <select>
                    <option value="0" disabled selected>category</option>
                    <?php
                    foreach ($showCategory as $category) {
                        ?>
                        <option value="<?= $category->id ?>"><?= $category->name ?></option> 
                    <?php } ?>
                </select>
            </div>
            <div class="col s12 m4">
                <select>
                    <option value="0" disabled selected>Temps de parution</option>
                    <option value="1">1 jour</option>
                    <option value="2">7 jour</option>
                    <option value="3">1 mois</option>
                    <option value="4">indéfini</option>
                </select>
            </div>
        </div>
        <h3 class="centerText">Description de l'article</h3>
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix">mode_edit</i>
                <textarea id="descArticle" name="descArticle" class="materialize-textarea validate" data-length="5000"></textarea>
                <label for="descArticle">Description de votre article</label>
            </div>
        </div>
        <h3 class="centerText">Ajout de photo(optionnel)</h3>
        <div class="row">
            <div class="file-field input-field col s12 m2 offset-l1">
                <img id="articleImageDisplayed" class="articleImg z-depth-3" src="../assets/IMG/articleImage/adding.png">
                <input type="file" name="articlePicture1" id="articlePicture1">
            </div>
            <div class="file-field input-field col s12 m2">
                <img id="articleImageDisplayed" class="articleImg z-depth-3" src="../assets/IMG/articleImage/adding.png">
                <input type="file" name="articlePicture2" id="articlePicture2">
            </div>
            <div class="file-field input-field col s12 m2">
                <img id="articleImageDisplayed" class="articleImg z-depth-3" src="../assets/IMG/articleImage/adding.png">
                <input type="file" name="articlePicture3" id="articlePicture3">
            </div>
            <div class="file-field input-field col s12 m2">
                <img id="articleImageDisplayed" class="articleImg z-depth-3" src="../assets/IMG/articleImage/adding.png">
                <input type="file" name="articlePicture4" id="articlePicture4">
            </div>
            <div class="file-field input-field col s12 m2">
                <img id="articleImageDisplayed" class="articleImg z-depth-3" src="../assets/IMG/articleImage/adding.png">
                <input type="file" name="articlePicture5" id="articlePicture5">
            </div>
        </div>
    </form>
</div>
<?php
include_once path::getViewsPath() . 'footer.php';
?>

