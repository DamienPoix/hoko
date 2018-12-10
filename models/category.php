<?php
//include de la base de donnée
include_once path::getClassesPath().'database.php';
//déclaration de la class category 
class category extends database {
    //listes des attributs
    public $id;
    public $name;
    /*
     * Méthode pour récuperer les catégories.
     */
    public function showCategory(){
        $request = 'SELECT `id`,`name` '
                . 'FROM `p24oi86_category`';
        $getCategory = $this->db->query($request);
        return $getCategory->fetchAll(PDO::FETCH_OBJ);
    }
}
