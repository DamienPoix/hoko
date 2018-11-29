<?php
include_once '../class/path.php';
include_once path::getControllersPath() . 'moreInfoCtl.php';
include_once path::getViewsPath() . 'header.php';
?>
<div class="border">
    <div class="row">
        <div class="col s12 m12 ">
            <img id="userImageDisplayed" class="moreInfoImg"  src="../assets/IMG/articleImage/no-picture.png" title="Image de l'article" alt="Image de l'article" />     
            <h2 class="purple-text centerText titleMod titleArt"><?= $articleInfo->name ?></h2>
            <p class="mtop  boldText acme catInfo ">catégorie : <?= $articleInfo->category ?></p>
            <p class="mtop  boldText acme locInfo ">localisation : <?= $articleInfo->department ?></p>
            <p class="mtop  boldText acme priceInfo green-text text-darken-2">Prix : <?= $articleInfo->price ?></p>
        </div>
    </div>
</div>
<div class="border">
    <div class="row">
        <div class="col s6 m6 mbot">
            <p class="left-align acme boldText dateArt">date d'ajout : <?= $articleInfo->postDate ?></p>
        </div>
        <div class="col s6 m6 mbot">
            <p class="right-align  acme boldText dateArt">disponible jusqu'au : <?= $articleInfo->endDate ?></p>
        </div>
    </div>
</div>
<div class="border centerText">
    <div class="row">
        <div class="col s12">
            <h3 class="purple-text centerText acme  ">description de l'article</h3>
            <p class="descInfo"><?= $articleInfo->description?></p>
        </div>
    </div>
</div>
<?php 
include_once path::getViewsPath() . 'footer.php';
?>