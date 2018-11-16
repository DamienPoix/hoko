<?php

include_once path::getClassesPath() . 'database.php';

//
class users extends database {

    //déclaration des attributs
    public $id;
    public $lastname;
    public $firstname;
    public $username;
    public $password;
    public $phone;
    public $birthdate;
    public $idUserType;
    public $idCivility;
    public $createDate;

    /*
     * Méthode pour l'ajout d'un utilisateur
     */

    public function addUser() {
        //déclaration de la requete sql
        $request = 'INSERT INTO `p24oi86_users`(`lastname`,`firstname`,`birthdate`,`phone`,`mail`,`username`,`password`,`idUserType`,`idCivility`,`createDate`) '
                . 'VALUES (:lastname, :firstname, :birthdate, :phone, :mail, :username, :password, :idUserType, :idCivility ,:createDate)';
        $insertUser = $this->db->prepare($request);
//        blind value permet de mettre une valeur a notre marqueur nominatif, il nous protége un minimum des injection sql
//        on utilise un bind value pour chaque clé nominatif
        $insertUser->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $insertUser->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $insertUser->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $insertUser->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $insertUser->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $insertUser->bindValue(':username', $this->username, PDO::PARAM_STR);
        $insertUser->bindValue(':password', $this->password, PDO::PARAM_STR);
        $insertUser->bindValue(':idUserType', $this->idUserType, PDO::PARAM_INT);
        $insertUser->bindValue(':idCivility', $this->idCivility, PDO::PARAM_INT);
        $insertUser->bindValue(':createDate', $this->createDate, PDO::PARAM_STR);
        return $insertUser->execute();
    }

    public function checkIfUserExist() {
        //initialisation de la variable $exist avec FALSE
        $exist = FALSE;
        //déclaration de la requête sql
        $request = 'SELECT COUNT(`id`) AS `count` '
                . 'FROM `p24oi86_users` '
                . 'WHERE `username` = :username';
        //appel de la requête avec un prepare  que l'on stocke dans la variable $result
        $result = $this->db->prepare($request);
        //attribution de la valeur au marqueur nominatif avec bindValue (protection contre les injections de sql)
        $result->bindValue(':username', $this->username, PDO::PARAM_STR);
        //vérification que la requête s'est bien exécutée
        if ($result->execute()) {
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            //attribution du résultat du count (0 ou 1) à la variable $exist
            $exist = $selectResult->count;
        }
        return $exist;
    }

   public function userConnect() {
        $exist = false;
        $request = 'SELECT `id`, `lastname`, `username`, `firstname`,`password`, DATE_FORMAT(`birthdate`, \'%d/%m/%Y\') AS `birthdate`,DATE_FORMAT(`createDate`, \'%d/%m/%Y\') AS `createDate`, `phone`, `mail`,`idCivility`, `idUserType` '
                . 'FROM `p24oi86_users` '
                . 'WHERE `username` = :username';
        $result = $this->db->prepare($request);
        $result->bindValue(':username', $this->username, PDO::PARAM_STR);
        if ($result->execute()) {
            $selectResult = $result->fetch(PDO::FETCH_OBJ);
            if (is_object($selectResult)) { //On vérifie que l'on a bien trouvé un utilisateur
                // On hydrate
                $this->id = $selectResult->id;
                $this->lastname = $selectResult->lastname;
                $this->username = $selectResult->username;
                $this->firstname = $selectResult->firstname;
                $this->password = $selectResult->password;
                $this->birthdate = $selectResult->birthdate;
                $this->createDate = $selectResult->createDate;
                $this->phone = $selectResult->phone;
                $this->mail = $selectResult->mail;
                $this->idCivility = $selectResult->idCivility;
                $this->idUserType = $selectResult->idUserType;
                $exist = true;
            }
        }
        return $exist;
    }

    /**
     * méthode pour récuperer les informations de l'utilisateur
     */
    public function getProfilUser() {
        $result = false;
        //déclaration de la requete sql
        $request = 'SELECT `id`, `lastname`, `username`, `firstname`, DATE_FORMAT(`birthdate`, \'%d/%m/%Y\') AS `birthdate`,DATE_FORMAT(`createDate`, \'%d/%m/%Y\') AS `createDate`, `phone`, `mail`,`idCivility`, `idUserType` '
                . 'FROM `p24oi86_users` '
                . 'WHERE `id` = :id';
        $profilUser = $this->db->prepare($request);
        //attribution des valeurs des id avec bindValue
        $profilUser->bindValue(':id', $this->id, PDO::PARAM_INT);
        $profilUser->execute();
        if (is_object($profilUser)) {
            //récupération des infos de l'utilisateur!! :)
            $result = $profilUser->fetch(PDO::FETCH_OBJ);
        }
        return $result;
    }

      public function updateUserContent() {
        //déclaration de la requête sql
        $request = 'UPDATE `p24oi86_users` '
                . 'SET `lastname` = :lastname,'
                . ' `firstname` = :firstname,'
                . ' `username` = :username,'
                . ' `birthdate` = :birthdate,'
                . ' `phone` = :phone,'
                . ' `mail` = :mail,'
                . ' `idCivility`= :idCivility,'
                . ' `idUserType` = :idUserType '
                . 'WHERE  `id` = :id';
        //appel de la requête avec un prepare (car il y a des marqueurs nominatifs) que l'on stocke dans la variable $updateUser
        $updateContent = $this->db->prepare($request);
        //attribution des valeurs aux marqueurs nominatifs avec bindValue (protection contre les injections de sql)
        $updateContent->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $updateContent->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $updateContent->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $updateContent->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $updateContent->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $updateContent->bindValue(':username', $this->username, PDO::PARAM_STR);
        $updateContent->bindValue(':idUserType', $this->idUserType, PDO::PARAM_INT);
        $updateContent->bindValue(':id', $this->id, PDO::PARAM_INT);
        $updateContent->bindValue(':idCivility', $this->idCivility, PDO::PARAM_INT);
        //vérification que la requête s'est bien exécutée
        if ($updateContent->execute()) {
            //vérification qu'il s'agit bien d'un objet
            if (is_object($updateContent)) {
                return $updateContent;
            }
        }
    }
    public function deleteUser(){
        $request = 'DELETE FROM `p24oi86_users`'
                . 'WHERE `id` = :id';
        $delete = $this->db->prepare($request);
        $delete->bindValue(':id', $this->id,PDO::PARAM_INT);
        //vérification que la requête s'est bien exécutée
        if ($delete->execute()) {
            //vérification qu'il s'agit bien d'un objet
            if (is_object($delete)) {
                return $delete;
            }
        }
    }
}
