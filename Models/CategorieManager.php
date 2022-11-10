<?php

class CategorieManager extends BDD {

    /**
     * Récupère toutes les categories
     */
    public function getCategories(){
        try {
            $result = $this->sqlPrepare("SELECT * FROM categorie", []);
            return array(parent::STATUSCODE_200, $result->fetchAll(PDO::FETCH_ASSOC));

        } catch (Exception $e) {
            return array(parent::STATUSCODE_500, ["error" => parent::STATUSCODE_500_TEXT, "method" => __METHOD__, "message" => $e->getMessage()]);
        }
    }

    /**
     * Récupère une categorie
     */
    public function getCategorie($id){

        if(parent::SIMULATE_STATUSCODE && in_array(parent::INT_STATUSCODE_TO_SIMULATE, parent::STATUSCODES_IN_ARRAY)){
            return array(parent::INT_STATUSCODE_TO_SIMULATE, ["error" => constant("parent::STATUSCODE_" . parent::INT_STATUSCODE_TO_SIMULATE . "_TEXT"), "method" => __METHOD__]);
        }
        
        if(!empty($id)){
            try {
                $result = $this->sqlPrepare("SELECT * FROM categorie WHERE id_categorie = ?", [$id]);
                return array(parent::STATUSCODE_200, $result->fetch(PDO::FETCH_ASSOC));

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::STATUSCODE_500_TEXT, "method" => __METHOD__,"message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::STATUSCODE_400_TEXT, "method" => __METHOD__]);
        }
    }

    /**
     * Créer une categorie
     */
    public function createCategorie(string $nom) : array {

        if(parent::SIMULATE_STATUSCODE && in_array(parent::INT_STATUSCODE_TO_SIMULATE, parent::STATUSCODES_IN_ARRAY)){
            return array(parent::INT_STATUSCODE_TO_SIMULATE, ["error" => constant("parent::STATUSCODE_" . parent::INT_STATUSCODE_TO_SIMULATE . "_TEXT"), "method" => __METHOD__]);
        }

        if(!empty($nom)){
            try {
                $this->sqlPrepare("INSERT INTO categorie(nom) VALUE(?)", [$nom]);
                return array(parent::STATUSCODE_200, true);

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::STATUSCODE_500_TEXT, "method" => __METHOD__, "message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::STATUSCODE_400_TEXT, "method" => __METHOD__]);
        }
    }

    /**
     * Met à jour une categorie
     */
    public function updateCategorie(string $id, string $nom) : array {

        if(parent::SIMULATE_STATUSCODE && in_array(parent::INT_STATUSCODE_TO_SIMULATE, parent::STATUSCODES_IN_ARRAY)){
            return array(parent::INT_STATUSCODE_TO_SIMULATE, ["error" => constant("parent::STATUSCODE_" . parent::INT_STATUSCODE_TO_SIMULATE . "_TEXT"), "method" => __METHOD__]);
        }

        if(!empty($nom) && !empty($id)){
            try {
                $this->sqlPrepare("UPDATE categorie SET nom = ? WHERE id_categorie = ?", [$nom, $id]);
                return array(parent::STATUSCODE_200, true);

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::STATUSCODE_500_TEXT, "method" => __METHOD__, "message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::STATUSCODE_400_TEXT, "method" => __METHOD__]);
        }
    }

    /**
     * Supprimer une categorie
     */
    public function deleteCategorie($id){

        if(parent::SIMULATE_STATUSCODE && in_array(parent::INT_STATUSCODE_TO_SIMULATE, parent::STATUSCODES_IN_ARRAY)){
            return array(parent::INT_STATUSCODE_TO_SIMULATE, ["error" => constant("parent::STATUSCODE_" . parent::INT_STATUSCODE_TO_SIMULATE . "_TEXT"), "method" => __METHOD__]);
        }

        if(!empty($id)){
            try {
                $this->sqlPrepare("DELETE FROM categorie WHERE id_categorie = ?", [$id]);
                return array(parent::STATUSCODE_200, true);

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::STATUSCODE_500_TEXT, "method" => __METHOD__, "message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::STATUSCODE_400_TEXT, "method" => __METHOD__]);
        }
    }

}