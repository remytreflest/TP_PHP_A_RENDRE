<?php

class RoleManager extends BDD {

    /**
     * Récupère toutes les roles
     */
    public function getRoles(){
        try {
            $result = $this->sqlPrepare("SELECT * FROM role", []);
            return array(parent::STATUSCODE_200, $result->fetchAll(PDO::FETCH_ASSOC));

        } catch (Exception $e) {
            return array(parent::STATUSCODE_500, ["error" => parent::STATUSCODE_500_TEXT, "method" => __METHOD__, "message" => $e->getMessage()]);
        }
    }

    /**
     * Récupère un role
     */
    public function getRole($id){

        if(parent::SIMULATE_STATUSCODE && in_array(parent::INT_STATUSCODE_TO_SIMULATE, parent::STATUSCODES_IN_ARRAY)){
            return array(parent::INT_STATUSCODE_TO_SIMULATE, ["error" => constant("parent::STATUSCODE_" . parent::INT_STATUSCODE_TO_SIMULATE . "_TEXT"), "method" => __METHOD__]);
        }
        
        if(!empty($id)){
            try {
                $result = $this->sqlPrepare("SELECT * FROM role WHERE id_role = ?", [$id]);
                return array(parent::STATUSCODE_200, $result->fetch(PDO::FETCH_ASSOC));

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::STATUSCODE_500_TEXT, "method" => __METHOD__,"message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::STATUSCODE_400_TEXT, "method" => __METHOD__]);
        }
    }

    /**
     * Créer un role
     */
    public function createRole(string $nom) : array {

        if(parent::SIMULATE_STATUSCODE && in_array(parent::INT_STATUSCODE_TO_SIMULATE, parent::STATUSCODES_IN_ARRAY)){
            return array(parent::INT_STATUSCODE_TO_SIMULATE, ["error" => constant("parent::STATUSCODE_" . parent::INT_STATUSCODE_TO_SIMULATE . "_TEXT"), "method" => __METHOD__]);
        }

        if(!empty($nom)){
            try {
                $this->sqlPrepare("INSERT INTO role(nom) VALUE(?)", [$nom]);
                return array(parent::STATUSCODE_200, true);

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::STATUSCODE_500_TEXT, "method" => __METHOD__, "message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::STATUSCODE_400_TEXT, "method" => __METHOD__]);
        }
    }

    /**
     * Met à jour un role
     */
    public function updateRole(string $id, string $nom) : array {

        if(parent::SIMULATE_STATUSCODE && in_array(parent::INT_STATUSCODE_TO_SIMULATE, parent::STATUSCODES_IN_ARRAY)){
            return array(parent::INT_STATUSCODE_TO_SIMULATE, ["error" => constant("parent::STATUSCODE_" . parent::INT_STATUSCODE_TO_SIMULATE . "_TEXT"), "method" => __METHOD__]);
        }

        if(!empty($nom) && !empty($id)){
            try {
                $this->sqlPrepare("UPDATE role SET nom = ? WHERE id_role = ?", [$nom, $id]);
                return array(parent::STATUSCODE_200, true);

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::STATUSCODE_500_TEXT, "method" => __METHOD__, "message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::STATUSCODE_400_TEXT, "method" => __METHOD__]);
        }
    }

    /**
     * Supprimer un role
     */
    public function deleteRole($id){
        if(!empty($id)){
            try {
                $this->sqlPrepare("DELETE FROM role WHERE id_role = ?", [$id]);
                return array(parent::STATUSCODE_200, true);

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::STATUSCODE_500_TEXT, "method" => __METHOD__, "message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::STATUSCODE_400_TEXT, "method" => __METHOD__]);
        }
    }

}