<?php

class ProduitManager extends BDD {

    /**
     * Récupère toutes les produit
     */
    public function getProduits(){
        try {
            $result = $this->sqlPrepare("SELECT p.*, c.nom as categorie FROM produit p LEFT JOIN categorie c ON p.FK_id_categorie = c.id_categorie", []);
            return array(parent::STATUSCODE_200, $result->fetchAll(PDO::FETCH_ASSOC));

        } catch (Exception $e) {
            return array(parent::STATUSCODE_500, ["error" => parent::STATUSCODE_500_TEXT, "method" => __METHOD__, "message" => $e->getMessage()]);
        }
    }

    /**
     * Récupère tous les modèles pour une marque
     */
    public function getProduitsByCategorie(string $idCategorie){

        if(parent::SIMULATE_STATUSCODE && in_array(parent::INT_STATUSCODE_TO_SIMULATE, parent::STATUSCODES_IN_ARRAY)){
            return array(parent::INT_STATUSCODE_TO_SIMULATE, ["error" => constant("parent::STATUSCODE_" . parent::INT_STATUSCODE_TO_SIMULATE . "_TEXT"), "method" => __METHOD__]);
        }
        
        if(!empty($idCategorie)){
            try {
                $result = $this->sqlPrepare("SELECT p.*, c.nom as categorie FROM produit p LEFT JOIN categorie c ON p.FK_id_categorie = c.id_categorie WHERE FK_id_categorie = ?", [$idCategorie]);
                return array(parent::STATUSCODE_200, $result->fetchAll(PDO::FETCH_ASSOC));

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::STATUSCODE_500_TEXT, "method" => __METHOD__, "message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::STATUSCODE_400_TEXT, "method" => __METHOD__]);
        }
    }

    /**
     * Récupère une marque
     */
    public function getProduit($id){

        if(parent::SIMULATE_STATUSCODE && in_array(parent::INT_STATUSCODE_TO_SIMULATE, parent::STATUSCODES_IN_ARRAY)){
            return array(parent::INT_STATUSCODE_TO_SIMULATE, ["error" => constant("parent::STATUSCODE_" . parent::INT_STATUSCODE_TO_SIMULATE . "_TEXT"), "method" => __METHOD__]);
        }
        
        if(!empty($id)){
            try {
                $result = $this->sqlPrepare("SELECT * FROM produit WHERE id_produit = ?", [$id]);
                return array(parent::STATUSCODE_200, $result->fetch(PDO::FETCH_ASSOC));

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::STATUSCODE_500_TEXT, "method" => __METHOD__, "message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::STATUSCODE_400_TEXT, "method" => __METHOD__]);
        }
    }

    /**
     * Créer un produit
     */
    public function createProduit(string $nom, string $description, float $prix, int $qte, string $idCategorie) : array {

        if(parent::SIMULATE_STATUSCODE && in_array(parent::INT_STATUSCODE_TO_SIMULATE, parent::STATUSCODES_IN_ARRAY)){
            return array(parent::INT_STATUSCODE_TO_SIMULATE, ["error" => constant("parent::STATUSCODE_" . parent::INT_STATUSCODE_TO_SIMULATE . "_TEXT"), "method" => __METHOD__]);
        }
        
        if(!empty($nom) && !empty($description) && !empty($prix) && !empty($qte) && !empty($idCategorie)){
            try {
                $this->sqlPrepare("INSERT INTO produit(nom, description, prix, qte, FK_id_categorie) VALUE(?, ?, ?, ?, ?)", [$nom, $description, $prix, $qte, $idCategorie]);
                return array(parent::STATUSCODE_200, true);

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::STATUSCODE_500_TEXT, "method" => __METHOD__, "message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::STATUSCODE_400_TEXT, "method" => __METHOD__]);
        }
    }

    /**
     * Met à jour un produit
     */
    public function updateProduit(string $id, string $nom, string $description, float $prix, int $qte, string $idCategorie) : array {

        if(parent::SIMULATE_STATUSCODE && in_array(parent::INT_STATUSCODE_TO_SIMULATE, parent::STATUSCODES_IN_ARRAY)){
            return array(parent::INT_STATUSCODE_TO_SIMULATE, ["error" => constant("parent::STATUSCODE_" . parent::INT_STATUSCODE_TO_SIMULATE . "_TEXT"), "method" => __METHOD__]);
        }

        if(!empty($id) && !empty($nom) && !empty($description) && !empty($prix) && !empty($qte) && !empty($idCategorie)){
            try {
                $this->sqlPrepare("UPDATE produit SET nom = ?, description = ?, prix = ?, qte = ?, FK_id_categorie = ? WHERE id_produit = ?", [$nom, $description, $prix, $qte, $idCategorie, $id]);
                return array(parent::STATUSCODE_200, true);

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::STATUSCODE_500_TEXT, "method" => __METHOD__, "message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::STATUSCODE_400_TEXT, "method" => __METHOD__]);
        }
    }

    /**
     * Supprimer un produit
     */
    public function deleteProduit($id){

        if(parent::SIMULATE_STATUSCODE && in_array(parent::INT_STATUSCODE_TO_SIMULATE, parent::STATUSCODES_IN_ARRAY)){
            return array(parent::INT_STATUSCODE_TO_SIMULATE, ["error" => constant("parent::STATUSCODE_" . parent::INT_STATUSCODE_TO_SIMULATE . "_TEXT"), "method" => __METHOD__]);
        }

        if(!empty($id)){
            try {
                $this->sqlPrepare("DELETE FROM produit WHERE id_produit = ?", [$id]);
                return array(parent::STATUSCODE_200, true);

            } catch (Exception $e) {
                return array(parent::STATUSCODE_500, ["error" => parent::STATUSCODE_500_TEXT, "method" => __METHOD__, "message" => $e->getMessage()]);
            }
        } else {
            return array(parent::STATUSCODE_400, ["error" => parent::STATUSCODE_400_TEXT, "method" => __METHOD__]);
        }
    }

}