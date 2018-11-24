<?php
//include de la base de donnée
include_once path::getClassesPath().'database.php';
//déclaration de la class location 
class location extends database {
    //listes des attributs
    public $id;
    public $department;
    /*
     * Méthode pour récuperer la location
     */
    public function showLocation(){
        $request = 'SELECT `id`,`department` '
                . 'FROM `p24oi86_location`';
        $getLocation = $this->db->query($request);
        return $getLocation->fetchAll(PDO::FETCH_OBJ);
    }
}
