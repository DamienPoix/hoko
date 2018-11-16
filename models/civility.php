<?php
//include de la base de donnée
include_once path::getClassesPath().'database.php';
//déclaration de la class civility 
class civility extends database {
    //listes des attributs
    public $id;
    public $civility;
    /*
     * Méthode pour récuperer la civilité
     */
    public function showCivility(){
        $request = 'SELECT `id`,`civility` '
                . 'FROM `p24oi86_civility`';
        $getCivility = $this->db->query($request);
        return $getCivility->fetchAll(PDO::FETCH_OBJ);
    }
}
