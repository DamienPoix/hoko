<?php
include_once 'class/path.php';
include_once path::getViewsPath() . 'header.php';
include_once path::getModelsPath() . 'indexCtl.php';
?>
<h1 class="centerText acme boldText">Bienvenue sur HOKO</h1>
<div class="container">
    <h2 class="centerText acme boldText" id="last">Les derniers articles mis en vente</h2>
    <?php
    foreach ($article as $a) {
        ?>
        <div class="border">
            <div class="row">
                <div class="col s12 m2">
                    <img id="userImageDisplayed" class="articleImg"  src="../assets/IMG/articleImage/no-picture.png" title="Image de l'article" alt="Image de l'article" /> 
                </div>
                <div class="row">
                    <div class="col s12 m6">
                        <h3 class="deep-purple-text accent-3 acme boldText "><?= $a->name ?></h3>
                        <p class="mtop  boldText acme"><?= $a->category ?></p>
                        <p class="mtop  boldText acme"><?= $a->department ?></p>
                        <p class="mtop  mbot fat acme boldText light-green-text darken-3 left-align">prix : <?= $a->price ?> €</p>
                    </div>
                    <div class=" col s12 m4">
                        <p class="datePos acme boldText right-align" >publié le : <?= $a->postDate ?></p>
                        <?php
                        if ($a->endDate != null) {
                            ?>
                            <p class=" acme boldText right-align">disponible jusqu'au : <?= $a->endDate ?></p>
                        <?php } else { ?>
                            <p class=" acme boldText right-align">disponible jusqu'a la suppresion</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    include_once path::getViewsPath() . 'footer.php';
    ?>