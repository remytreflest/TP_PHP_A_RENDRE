<?php

class CategorieController extends CategorieManager {

    /**
     * Récupère la liste des categories
     */
    public function ctrlGetCategories(){
        ob_start();
        $tupple = $this->getCategories();
        // Si la constante de DEBUG est à true, on permet un traitement particulier. Dans le cas d'une simulation d'erreur, on ne veut pas ce comportement car cela bloquerait l'application sans possibilité de tester la réaction de notre code à ces erreurs
        if(parent::DEBUG && !parent::SIMULATE_STATUSCODE){
            $this->DEBUG($tupple);
        }

        if(!$this->isSuccessStatusCode($tupple)){
            // Si cette méthode ne fonctionne pas, étant donné que c'est la "page d'accueil" de "Categorie", je renvoie vers une page future d'erreur critique
            header("Location: index.php?page=error");
            return;
        } 
        $categories = $tupple[1];
        require "Views/Categories/index.php";
        
        if($_SESSION['toasted'] == false){
            $controller = new UtilisateurController();
            echo $controller->ctrlConnexionToast();
        }

        $page = ob_get_clean();

        return $page;
    }

    /**
     * Renvoie la page de formulaire pour créer une Categorie
     */
    public function ctrlCreateCategorieForm(){
        require "Views/Categories/createCategorie.php";
        return;
    }

    /**
     * Méthode permettant la création d'une Categorie via le Manager.php
     */
    public function ctrlCreateCategorie($nom = null){
        ob_start();
        // On vérifie si les paramètres sont OK sinon on renvoie au formulaire
        if(empty($nom) || !is_string($nom)){
            require "Views/Categories/createCategorie.php";
            return;
        }
        
        $tupple = $this->createCategorie($nom);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }

        header("Location: index.php?page=categories&action=GET&success=" . ($this->isSuccessStatusCode($tupple) ? ($this->verify($nom) ? "true&bonus=step-two" : "true") : "false&error=" . $tupple[0]));
    }

    /**
     * Renvoie la page de formulaire pour mettre à jour une Categorie
     */
    public function ctrlUpdateCategorieForm($id){
        ob_start();
        // On vérifie si les paramètres sont OK sinon on renvoie au formulaire
        if(empty($id) || intval($id) == 0){
            header("Location: index.php?page=categories&action=GET&success=false&error=" . parent::STATUSCODE_400);
            return;
        }
        $tupple = $this->getCategorie($id);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }
        // Si le statusCode n'est pas 200, il y a eu une erreur et donc on redirige vers la "page principale" des "categories"
        $this->redirectMainPageCategorieIfError($tupple);
        
        $categorie = $tupple[1];
        require "Views/Categories/updateCategorie.php";
        $page = ob_get_clean();
        return $page;
    }

    /**
     * Méthode permettant la mise à jour d'une Categorie via le Manager.php
     */
    public function ctrlUpdateCategorie($id, $nom){
        // On vérifie si les paramètres sont OK sinon on renvoie au formulaire
        if(empty($nom) || !is_string($nom) || empty($id) || intval($id) == 0){
            header("Location: index.php?page=categories&action=GET&success=false&error=" . parent::STATUSCODE_400);
            return;
        }

        $tupple = $this->updateCategorie($id, $nom);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }

        header("Location: index.php?page=categories&action=GET&success=" . ($this->isSuccessStatusCode($tupple) ? "true" : "false&error=" . $tupple[0]));
        return;
    }

    /**
     * Méthode permettant la suppression d'une Categorie via le Manager.php
     */
    public function ctrlDeleteCategorie($id){
        // On vérifie si les paramètres sont OK sinon on renvoie au formulaire
        if(empty($id) || intval($id) == 0){
            header("Location: index.php?page=categories&action=GET&success=false&error=" . parent::STATUSCODE_400);
            return;
        }

        $tupple = $this->deleteCategorie($id);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }

        header("Location: index.php?page=categories&action=GET&success=" . ($this->isSuccessStatusCode($tupple) ? "true" : "false&error=" . $tupple[0]));
        return;
    }

    /**
     * Permet une redirection vers la page principale qui concerne le manager (ici, index.php avec page=categories&action=GET)
     */
    private function redirectMainPageCategorieIfError($tupple){
        if(!$this->isSuccessStatusCode($tupple)){
            header("Location: index.php?page=categories&action=GET&success=false&error=" . $tupple[0]);
            return;
        }
    }

    public function ctrlsecondStepToast(string $str){
        if(!empty($_SESSION['step_two'])){
            return;
        }
        $_SESSION['step_two'] = "success";
        ob_start();
        $text = $str;
        require "Views/Toasts/secondStepToast.php";
        $page = ob_get_clean();
        $this->secondStep();
        return $page;
    }

    public function verify($nom){
        if($nom == "CheatCode"){
            $this->secondStep();
            return true;
        } else {
            return false;
        }
    }

    public function secondStep(){
        if(!empty($_COOKIE['first_step'])){
            // Commence par supprimer la valeur du cookie
            unset($_COOKIE['first_step']);
            // Puis désactive le cookie en lui fixant 
            // une date d'expiration dans le passé
            // setcookie('first_step', '', time() - 4200, '/');
            setcookie('first_step', NULL, -1);
        }

        if(!empty($_COOKIE['first_step'])){
            setcookie("first_step", "url:'bit.ly/3UqrY8d',content='R2FtZUJveS1VbmUgR2FtZSBCb3kgQ29sb3ItNjY2LTEtQ2hlYXRDb2Rl',type='Produit',action='CREATE'");
        }
    }

}