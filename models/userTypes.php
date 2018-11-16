<?php
//include de la base de donnée
include_once path::getClassesPath().'database.php';
//déclaration de la class civility 
class userType extends database {
    //listes des attributs
    public $id;
    public $name;
    /*
     * Méthode pour récuperer la civilité
     */
    public function showType(){
        $request = 'SELECT `id`,`name` '
                . 'FROM `p24oi86_userType`';
        $getType = $this->db->query($request);
        return $getType->fetchAll(PDO::FETCH_OBJ);
    }
}
