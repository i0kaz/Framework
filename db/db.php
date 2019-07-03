<?php

class DB {

    public function __construct() {

    }

    private function Connect() {
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $name = 'portfolio';

        return new PDO('mysql:host='.$host.';dbname='.$name,$user,$pass);
    }

    private function Query($query) {
        /*

            call to bdd --> envoie de la requête renvoi (true, chose à renvoyer éventuellement) si reussi sinon (false + erreur)

        */
        $db = $this->Connect();
        $query = $db->query($query);
        if (!$query) {
            return [false, $db->errorInfo()];
        }
        return [true];
    }

    public function CreateDataBase($name) {
        if (!$this->VerifDatabase($name)[0]) {
            return [false, "Database Already Exist"];
        }

        $query = "CREATE DATABASE `". $name ."` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";

        $res = $this->Query($query);

        if (!$res) {
            return [false, $res->errorInfo()];
        }

        return [true, "Create database accomplished"];

    }

    public function CreateTable($name, $params) {
        $query = "";


        // verification de si les tables existent ou pas 
        if ($this->VerifTable($name)) {
            // si existe verification de si on drop la table ou non 
            if (!$this->DropTable($name)) {
                // pour le moment annulation de la création de table 
                // ensuite je réfléchirai à si je la supprime ou si je la met à jour (ajout et suppression de ligne --> beaucoup plus fin et donc beaucoup plus complexe)
                $res = [false, "Table Not Drop"];
                return $res;
            }
            // si table suppr --> sorti du if 
            die;
        }

        // creation de la table 
        $query = "CREATE TABLE `portfolio`.";

        // on met les noms des tables au format Majuscule en début, minuscule ensuite
        $query = $query . "`". ucfirst($name) ."` ";

        // on met obligatoirement l'identifiant avec l'id pour plus de simplicité
        $query = $query. "(`id` SERIAL NOT NULL, ";
        $nb = count($params);

        // on parcourt les paramètres envoyés et on les met 
        foreach ($params as $param => $type) {
            if ($nb > 1) {
                $query = $query. " `". $param ."` ". $type .",";
            }
            else {
                $query = $query. " `". $param ."` ". $type;
            }
            $nb--;
        }
        $query = $query . ') ENGINE = InnoDB;';
        
        $res = $this->Query($query);

        // si création de table à réussi true sinon (false + erreur)
        return $res;
    }

    public function VerifDatabase($name) {
        
        $db = $this->Connect();

        $query = "IF EXISTS (SELECT name FROM `information_schema`.`SCHEMATA` WHERE `SCHEMA_NAME` = ". $name .");";

        $res = $db->Query($query);
        
        if (!$res) {
            return [false, $db->errorInfo()];
        }

        return $res;
    }

    public function VerifTable($name) {
        /*


        QUERY DE VERIF TABLE

            (QUERY ~= IF EXIST TRUE ELSE FALSE)


        */
        $query = "SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = '". $name ."'";

        if($this->Query($query)) {
            $res = true;
        } else {
            false;
        }

        // si existe --> true sinon --> false
        return $res;
    }

    public function DropTable($name) {
        /*

            Demande si DROP TABLE

                SI OUI -> DROP TABLE , $res = true
                SI NON -> $res = false            

        */

        $res = false;
        return $res;
    }
}