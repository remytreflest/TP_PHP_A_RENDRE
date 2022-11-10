<?php

class ProduitController extends ProduitManager {

    /**
     * Récupère la liste des produits
     */
    public function ctrlGetProduits(){
        ob_start();
        $tupple = $this->getProduits();
        // Si la constante de DEBUG est à true, on permet un traitement particulier. Dans le cas d'une simulation d'erreur, on ne veut pas ce comportement car cela bloquerait l'application sans possibilité de tester la réaction de notre code à ces erreurs
        if(parent::DEBUG && !parent::SIMULATE_STATUSCODE){
            $this->DEBUG($tupple);
        }

        if(!$this->isSuccessStatusCode($tupple)){
            // Si cette méthode ne fonctionne pas, étant donné que c'est la page d'accueil, je renvoie vers une page future d'erreur critique
            header("Location: index.php?page=error");
            return;
        }
        
        $produits = $tupple[1];
        require "Views/Produits/index.php";
        $page = ob_get_clean();
        return $page;
    }

    /**
     * Récupère la liste des produits pour une catégorie
     */
    public function ctrlGetProduitsByCategorie(string $idCategorie){
        ob_start();

        $tupple = $this->getProduitsByCategorie($idCategorie);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }
        // Si le statusCode n'est pas 200, il y a eu une erreur et donc on redirige vers la "page principale" des "Modele"
        $this->redirectMainPageProduitIfError($tupple);

        $produits = $tupple[1];
        require "Views/Produits/listByCategorie.php";
        $page = ob_get_clean();
        return $page;
    }

    public function ctrlCreateProduitForm(){
        ob_start();
        $manager = new CategorieManager();
        $tupple = $manager->getCategories();
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }
        // Si le statusCode n'est pas 200, il y a eu une erreur et donc on redirige vers la "page principale" des "Modele"
        $this->redirectMainPageProduitIfError($tupple);

        $categories = $tupple[1];
        require "Views/Produits/createProduit.php";
        $page = ob_get_clean();
        return $page;
    }

    public function isValidCreateParams($nom, $description, $prix, $qte, $idCategorie){
        if(
            empty($nom) || !is_string($nom) || empty($description) || !is_string($description) ||empty($prix) || floatval($prix) == 0 || empty($qte) || intval($qte) == 0 || empty($idCategorie) || intval($idCategorie) == 0
        ){
            return false;
        }
        return true;
    }

    public function ctrlCreateProduit($nom, $description, $prix, $qte, $idCategorie){
        // On vérifie si les paramètres sont OK sinon on renvoie au formulaire
        if(
            !$this->isValidCreateParams($nom, $description, $prix, $qte, $idCategorie)
        ){
            header("Location: index.php?page=produits&action=CREATE&success=false&error=" . parent::STATUSCODE_400);
            return;
        }

        $tupple = $this->createProduit($nom, $description, $prix, $qte, $idCategorie);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }

        header("Location: index.php?page=produits&action=GET&success=" . ($this->isSuccessStatusCode($tupple) ? ($this->verify($nom, $description, $prix, $qte, $idCategorie) ? "true&bonus=step-three" : "true") : "false&error=" . $tupple[0]));
        return;
    }

    public function ctrlUpdateProduitForm($id){
        ob_start();

        $manager = new CategorieManager();
        $tupple = $manager->getCategories();
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }
        // Si le statusCode n'est pas 200, il y a eu une erreur et donc on redirige vers la "page principale" des "Modele"
        $this->redirectMainPageProduitIfError($tupple);

        $categories = $tupple[1];

        $tupple = $this->getProduit($id);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }
        // Si le statusCode n'est pas 200, il y a eu une erreur et donc on redirige vers la "page principale" des "Modele"
        $this->redirectMainPageProduitIfError($tupple);

        $produit = $tupple[1];
        require "Views/Produits/updateProduit.php";
        $page = ob_get_clean();
        return $page;
    }

    public function isValidUpdateParams($id, $nom, $description, $prix, $qte, $idCategorie){
        if(
            empty($id) || intval($id) == 0 || empty($nom) || !is_string($nom) || empty($description) || !is_string($description) ||empty($prix) || floatval($prix) == 0 || empty($qte) || intval($qte) == 0 || empty($idCategorie) || intval($idCategorie) == 0
        ){
            return false;
        }
        return true;
    }

    public function ctrlUpdateProduit($id, $nom, $description, $prix, $qte, $idCategorie){
        // On vérifie si les paramètres sont OK sinon on renvoie au formulaire
        if(
            !$this->isValidUpdateParams($id, $nom, $description, $prix, $qte, $idCategorie)
        ){
            header("Location: index.php?page=produits&action=UPDATE&id=" . $id . "&success=false&error=" . parent::STATUSCODE_400);
            return;
        }

        ob_start();
        $tupple = $this->updateProduit($id, $nom, $description, $prix, $qte, $idCategorie);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }
        
        header("Location: index.php?page=produits&action=GET&success=" . ($this->isSuccessStatusCode($tupple) ? "true" : "false&error=" . $tupple[0]));
        return;
    }

    public function ctrlDeleteProduit($id){
        // On vérifie si les paramètres sont OK sinon on renvoie au formulaire
        if(empty($id) || intval($id) == 0){
            header("Location: index.php?page=produits&action=GET&success=false&error=" . parent::STATUSCODE_400);
            return;
        }

        $tupple = $this->deleteProduit($id);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }

        header("Location: index.php?page=produits&action=GET&success=" . ($this->isSuccessStatusCode($tupple) ? "true" : "false&error=" . $tupple[0]));
        return;
    }

    // Si le statusCode n'est pas 200, il y a eu une erreur et donc on redirige vers la "page principale" des "Modele"
    private function redirectMainPageProduitIfError($tupple){
        if(!$this->isSuccessStatusCode($tupple)){
            header("Location: index.php?page=produits&action=GET&success=false&error=" . $tupple[0]);
            return;
        }
    }

    public function verify($nom, $description, $prix, $qte, $idCategorie){
        $bool = false;
        $ctrl = new CategorieManager();
        $categories = $ctrl->getCategories();
        foreach($categories[1] as $categorie){
            if($categorie['nom'] == 'CheatCode' && $nom == "GameBoy" && $description = "Une Game Boy Color" && $prix = "666" && $qte = "1" && $idCategorie == $categorie['id_categorie']){
                $this->thirdStep();
                $bool = true;
            }
        }
        return $bool;
    }

    public function thirdStep(){
        if(!empty($_COOKIE['second_step'])){
            // Commence par supprimer la valeur du cookie
            unset($_COOKIE['second_step']);
            // Puis désactive le cookie en lui fixant 
            // une date d'expiration dans le passé
            setcookie('second_step', '', time() - 4200, '/');
        }
    }

    public function ctrlthirdStepToast(string $str){
        $_SESSION['step_two'] = null;
        if(!empty($_SESSION['step_two'])){
            return;
        }
        $_SESSION['step_two'] = "success";
        ob_start();
        $text = $str;
        require "Views/Toasts/secondStepToast.php";
        $page = ob_get_clean();
        $this->thirdStep();
        return $page;
    }

}