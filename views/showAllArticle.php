<?php
include_once '../class/path.php';
include_once path::getViewsPath() . 'header.php';
include_once path::getControllersPath() . 'showAllArticleCtl.php';
?>
<div class="container">
    <h2 class="centerText acme boldText" id="last">Article mis en Vente</h2>
    <?php
    foreach ($showArticle as $a) {
        ?>
        <div class="border white">
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
                        <a class="btn deep-purple right moreInfo" href="Article-Infos-<?= $a->id ?>">plus d'information</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <ul class="pagination centerText">
        <?php
        if ($limitStart >= 1) {
            ?>
            <li><a href="Article?page=<?= $page - 1 ?>"><i class="material-icons">chevron_left</i></a></li>
            <?php
        }
        for ($pageNumber = 1; $pageNumber <= $totalPage; $pageNumber ++) {
            ?>
            <li class="active "><a href="Article?page=<?= $pageNumber ?>" class=" boldText acme deep-purple"><?= $pageNumber ?></a></li>
            <?php
        }
        if ($limitStart <= $totalPage) {
            ?>
            <li class="waves-effect <?= $limitStart >= $totalPage ? 'disable' : '' ?>"><a href="Article?page=<?= $page + 1 ?>"><i class="material-icons">chevron_right</i></a></li>
            <?php } ?>
    </ul>
    <?php
    include_once path::getViewsPath() . 'footer.php';
    ?>