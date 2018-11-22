<?php

//include de la database
include_once path::getClassesPath() . 'database.php';

class pictures extends database {

    //déclaration des attributs 
    public $id;
    public $idArticle;
    public $pictures;

    public function addPicturesWhithArticle() {
        $request = 'INSERT INTO `p24oi86_pictures`(`pictures`, `idArticle`)'
                . 'VALUES (:pictures, :idArticle)';
        $pictureAdd = $this->db->prepare($request);
        //        blind value permet de mettre une valeur a notre marqueur nominatif, il nous protége un minimum des injection sql
        //        on utilise un bind value pour chaque clé nominatif
        $pictureAdd = bindValue('pictures', $this->pictures, PDO::PARAM_STR);
        $pictureAdd = bindValue('idArticle', $this->idArticle, PDO::PARAM_INT);
        return $pictureAdd->execute();
    }

}
