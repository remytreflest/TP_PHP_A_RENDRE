<?php

class BDD extends Constantes {

    private $dsn = "mysql:host=localhost;dbname=boutique;charset=UTF8";
    private $username = "root";
    private $password = "";
    private $co = false;

    protected function getBdd()
    {
        if(!$this->co){
            try {

                $this->co = new PDO($this->dsn, $this->username, $this->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                return $this->co;
    
            } catch (Exception $ex){
                
                die($ex->getMessage());
            }
        } else {
            return $this->co;
        }
    }

    // Méthode rassemblant le "prepare" et le "execute" pour faire un appel SQL
    protected function sqlPrepare(string $requete, array $params) : PDOStatement {
        $query = $this->getBdd()->prepare($requete);
        $query->execute($params);
        return $query;
    }

    // Permet de tester si le statusCode de retour est 200 (donc si tout s'est bien passé)
    protected function isSuccessStatusCode($tupple){
        return $tupple[0] == parent::STATUSCODE_200;
    }

    public static function requireErrorView($statusCode){
        require "Views/StatusCode/statusCode" . $statusCode . ".php";
    }

    protected function DEBUG($tupple){
        // En cas d'erreur, on affiche un tableau contenant l'erreur (sera plus visible si la const EXIT_WHEN_ERROR est à true car stop le déroulement ud programme)
        if(!$this->isSuccessStatusCode($tupple)){
            if(parent::SHOW_ERROR){
                var_dump($tupple);
                exit;
            }
        }
    }

}