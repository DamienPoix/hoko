<?php
//include du fichier de configuration
include_once path::getRootPath().'configuration.php';
/**
 * création de la class database parent.Qui permet de se connecter a la base de donées
 */
class database {

    // Liste des attributs
    protected $db;
    public $id;
    public $type;

    public function __construct() {
        $this->host = HOST;
        $this->dbname = DBNAME;
        $this->login = LOGIN;
        $this->password = PASSWORD;
        // On test les erreurs avec le try/catch
        // Si tout est bon, on est connecté à la base de donnée
        try {
            $this->db = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';charset=UTF8;', $this->login, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        //Autrement, un message d'erreur est affiché
        catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function __destruct() {
        $this->db = NULL;
    }

}
