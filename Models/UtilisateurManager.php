<?php

class UtilisateurManager extends BDD {

    /**
     * Récupère toutes les utilisateurs
     */
    public function getUtilisateurs(){

        try {
            $result = $this->sqlPrepare("SELECT u.*, r.nom as role FROM utilisateur u LEFT JOIN role r ON u.FK_id_role = r.id_role", []);
            return array(parent::STATUSCODE_200, $result->fetchAll(PDO::FETCH_ASSOC));

        } catch (Exception $e) {
            return array(parent::STATUSCODE_500, ["error" => parent::STATUSCODE_500_TEXT, "method" => __METHOD__, "message" => $e->getMessage()]);
        }
    }

    /**
     * Récupère un utilisateur
     */
    public function getUtilisateur($id){
        
        if(parent::SIMULATE_STATUSCODE && in_array(parent::INT_STATUSCODE_TO_SIMULATE, parent::STATUSCODES_IN_ARRAY)){
            return array(parent::INT_STATUSCODE_TO_SIMULATE, ["error" => constant("parent::STATUSCODE_" . parent::INT_STATUSCODE_TO_SIMULATE . "_TEXT"), "method" => __METHOD__]);
        }

        if(!empty($id)){
            try {
                $result = $this->sqlPrepare("SELECT u.*, r.nom as role FROM utilisateur u LEFT JOIN role r ON u.FK_id_role = r.id_role WHERE id_utilisateur = ?", [$id]);
                return array(parent::STATUSCODE_200, $result->fetch(PDO::FETCH_ASSOC));

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::STATUSCODE_500_TEXT, "method" => __METHOD__,"message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::STATUSCODE_400_TEXT, "method" => __METHOD__]);
        }
    }

    /**
     * Créer un utilisateur
     */
    public function createUtilisateur(string $prenom, string $nom, string $email, string $mdp, int $idRole) : array {
        
        if(parent::SIMULATE_STATUSCODE && in_array(parent::INT_STATUSCODE_TO_SIMULATE, parent::STATUSCODES_IN_ARRAY)){
            return array(parent::INT_STATUSCODE_TO_SIMULATE, ["error" => constant("parent::STATUSCODE_" . parent::INT_STATUSCODE_TO_SIMULATE . "_TEXT"), "method" => __METHOD__]);
        }

        if(
            !empty($prenom) && !empty($nom) && !empty($email) && !empty($mdp) && !empty($idRole)
        ){
            try {
                $mdp = password_hash($mdp, PASSWORD_BCRYPT);
                $this->sqlPrepare("INSERT INTO utilisateur(prenom, nom, email, mdp, FK_id_role) VALUE(?, ?, ?, ?, ?)", [$this->verifyPrenom($prenom), $this->verifyNom($nom), $email, $mdp, $idRole]);
                return array(parent::STATUSCODE_200, true);

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::STATUSCODE_500_TEXT, "method" => __METHOD__, "message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::STATUSCODE_400_TEXT, "method" => __METHOD__]);
        }
    }

    /**
     * Met à jour un utilisateur
     */
    public function updateUtilisateur(string $id, string $prenom, string $nom, string $email, string $mdp, int $idRole) : array {
        
        if(parent::SIMULATE_STATUSCODE && in_array(parent::INT_STATUSCODE_TO_SIMULATE, parent::STATUSCODES_IN_ARRAY)){
            return array(parent::INT_STATUSCODE_TO_SIMULATE, ["error" => constant("parent::STATUSCODE_" . parent::INT_STATUSCODE_TO_SIMULATE . "_TEXT"), "method" => __METHOD__]);
        }

        if(
            !empty($id) && !empty($prenom) && !empty($nom) && !empty($email) && !empty($mdp) && !empty($idRole)
        ){
            try {
                $mdp = password_hash($mdp, PASSWORD_BCRYPT);
                $this->sqlPrepare("UPDATE utilisateur SET prenom = ?, nom = ?, email = ?, mdp = ?, FK_id_role = ? WHERE id_utilisateur = ?", [$prenom, $nom, $email, $mdp, $idRole, $id]);
                return array(parent::STATUSCODE_200, true);

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::STATUSCODE_500_TEXT, "method" => __METHOD__, "message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::STATUSCODE_400_TEXT, "method" => __METHOD__]);
        }
    }

    /**
     * Supprimer un utilisateur
     */
    public function deleteUtilisateur($id){

        if(parent::SIMULATE_STATUSCODE && in_array(parent::INT_STATUSCODE_TO_SIMULATE, parent::STATUSCODES_IN_ARRAY)){
            return array(parent::INT_STATUSCODE_TO_SIMULATE, ["error" => constant("parent::STATUSCODE_" . parent::INT_STATUSCODE_TO_SIMULATE . "_TEXT"), "method" => __METHOD__]);
        }

        if(!empty($id)){
            try {
                $this->sqlPrepare("DELETE FROM utilisateur WHERE id_utilisateur = ?", [$id]);
                return array(parent::STATUSCODE_200, true);

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::STATUSCODE_500_TEXT, "method" => __METHOD__, "message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::STATUSCODE_400_TEXT, "method" => __METHOD__]);
        }
    }

    /**
     * Check si un email est Unique en BDD
     */
    public function isUniqueEmail($email){

        if(parent::SIMULATE_STATUSCODE && in_array(parent::INT_STATUSCODE_TO_SIMULATE, parent::STATUSCODES_IN_ARRAY)){
            return array(parent::INT_STATUSCODE_TO_SIMULATE, ["error" => constant("parent::STATUSCODE_" . parent::INT_STATUSCODE_TO_SIMULATE . "_TEXT"), "method" => __METHOD__]);
        }

        if(!empty($email)){
            try {
                $result = $this->sqlPrepare("SELECT COUNT(*) FROM utilisateur WHERE email = ?", [$email]);
                return array(parent::STATUSCODE_200, ($result->rowCount() == 0));

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::STATUSCODE_500_TEXT, "method" => __METHOD__, "message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::STATUSCODE_400_TEXT, "method" => __METHOD__]);
        }
    }

    public function connexion($email, $mdp){ 

        if(parent::SIMULATE_STATUSCODE && in_array(parent::INT_STATUSCODE_TO_SIMULATE, parent::STATUSCODES_IN_ARRAY)){
            return array(parent::INT_STATUSCODE_TO_SIMULATE, ["error" => constant("parent::STATUSCODE_" . parent::INT_STATUSCODE_TO_SIMULATE . "_TEXT"), "method" => __METHOD__]);
        }
        
        if(!empty($email) && !empty($mdp)){
            try {
                $result = $this->sqlPrepare("SELECT u.*, r.nom as role FROM utilisateur u LEFT JOIN role r ON u.FK_id_role = r.id_role WHERE email = ?", [$email]);
                $utilisateur = $result->fetch(PDO::FETCH_ASSOC);

                if(!password_verify($mdp, $utilisateur["mdp"])){
                    return array(parent::STATUSCODE_401, false);
                }

                $_SESSION["id_utilisateur"] = $utilisateur["mdp"];
                $_SESSION["nom"] = $utilisateur["nom"];
                $_SESSION["prenom"] = $utilisateur["prenom"];
                $_SESSION["email"] = $utilisateur["email"];
                $_SESSION["FK_id_role"] = $utilisateur["FK_id_role"];
                $_SESSION["role"] = $utilisateur["role"];
                $_SESSION['toasted'] = false;

                return array(parent::STATUSCODE_200, true);

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::STATUSCODE_500_TEXT, "method" => __METHOD__, "message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::STATUSCODE_400_TEXT, "method" => __METHOD__]);
        }
    }

    private function verifyNom($nom){
        return in_array(strtoupper($nom), parent::NOMS) ? strtoupper($nom) : $nom;
    }
    private function verifyPrenom($prenom){
        return in_array(strtoupper($prenom), parent::PRENOMS) ? strtoupper($prenom) : $prenom;
    }

}