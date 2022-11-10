<?php

class UtilisateurController extends UtilisateurManager {

    /**
     * Récupère la liste des Utilisateurs
     */
    public function ctrlGetUtilisateurs(){
        ob_start();
        $tupple = $this->getUtilisateurs();
        // Si la constante de DEBUG est à true, on permet un traitement particulier. Dans le cas d'une simulation d'erreur, on ne veut pas ce comportement car cela bloquerait l'application sans possibilité de tester la réaction de notre code à ces erreurs
        if(parent::DEBUG && !parent::SIMULATE_STATUSCODE){
            $this->DEBUG($tupple);
        }

        if(!$this->isSuccessStatusCode($tupple)){
            // Si cette méthode ne fonctionne pas, étant donné que c'est la page d'accueil, je renvoie vers une page future d'erreur critique
            header("Location: index.php?page=error");
            return;
        }
        
        $utilisateurs = $tupple[1];
        require "Views/Utilisateurs/index.php";
        $page = ob_get_clean();
        return $page;
    }

    public function ctrlCreateUtilisateurForm(){
        ob_start();
        $manager = new RoleManager();
        $tupple = $manager->getRoles();
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }
        // Si le statusCode n'est pas 200, il y a eu une erreur et donc on redirige vers la "page principale" des "Modele"
        $this->redirectMainPageUtilisateurIfError($tupple);

        $roles = $tupple[1];
        require "Views/Utilisateurs/createUtilisateur.php";
        $page = ob_get_clean();
        return $page;
    }

    public function isValidCreateParams($nom, $prenom, $email, $mdp, $idRole){
        if(
            empty($nom) || !is_string($nom) || empty($prenom) || !is_string($prenom) || empty($email) || !is_string($email) || !$this->isUniqueEmail($email) || empty($mdp) || !is_string($mdp) || empty($idRole) || intval($idRole) == 0
        ){
            return false;
        }
        return true;
    }

    public function ctrlCreateUtilisateur($nom, $prenom, $email, $mdp, $idRole){
        // On vérifie si les paramètres sont OK sinon on renvoie au formulaire
        if(
            !$this->isValidCreateParams($nom, $prenom, $email, $mdp, $idRole)
        ){
            header("Location: index.php?page=utilisateurs&action=GET&success=false&error=" . parent::STATUSCODE_400);
            return;
        }

        $tupple = $this->createUtilisateur($nom, $prenom, $email, $mdp, $idRole);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }
        $this->verify();
        header("Location: index.php?page=utilisateurs&action=GET&success=" . ($this->isSuccessStatusCode($tupple) ? "true" : "false&error=" . $tupple[0]));
        return;
    }

    public function ctrlUpdateUtilisateurForm($id){
        ob_start();

        $manager = new RoleManager();
        $tupple = $manager->getRoles();
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }
        // Si le statusCode n'est pas 200, il y a eu une erreur et donc on redirige vers la "page principale" des "Modele"
        $this->redirectMainPageUtilisateurIfError($tupple);

        $roles = $tupple[1];

        $tupple = $this->getUtilisateur($id);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }
        // Si le statusCode n'est pas 200, il y a eu une erreur et donc on redirige vers la "page principale" des "Modele"
        $this->redirectMainPageUtilisateurIfError($tupple);

        $utilisateur = $tupple[1];
        require "Views/Utilisateurs/updateUtilisateur.php";
        $page = ob_get_clean();
        return $page;
    }

    public function isValidUpdateParams($id, $nom, $prenom, $email, $mdp, $idRole){
        if(
            empty($id) || intval($id) == 0 || empty($nom) || !is_string($nom) || empty($prenom) || !is_string($prenom) || empty($email) || !is_string($email) || !$this->isUniqueEmail($email) || empty($mdp) || !is_string($mdp) || empty($idRole) || intval($idRole) == 0
        ){
            return false;
        }
        return true;
    }

    public function ctrlUpdateUtilisateur($id, $nom, $prenom, $email, $mdp, $idRole){
        // On vérifie si les paramètres sont OK sinon on renvoie au formulaire
        if(
            !$this->isValidUpdateParams($id, $nom, $prenom, $email, $mdp, $idRole)
        ){
            header("Location: index.php?page=utilisateurs&action=UPDATE&id=" . $id . "&success=false&error=" . parent::STATUSCODE_400);
            return;
        }

        ob_start();
        $tupple = $this->updateUtilisateur($id, $nom, $prenom, $email, $mdp, $idRole);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }
        
        header("Location: index.php?page=utilisateurs&action=GET&success=" . ($this->isSuccessStatusCode($tupple) ? "true" : "false"));
        return;
    }

    public function ctrlDeleteUtilisateur($id){
        // On vérifie si les paramètres sont OK sinon on renvoie au formulaire
        if(empty($id) || intval($id) == 0){
            header("Location: index.php?page=utilisateurs&action=GET&success=false&error=" . parent::STATUSCODE_400);
            return;
        }

        $tupple = $this->deleteUtilisateur($id);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }

        header("Location: index.php?page=utilisateurs&action=GET&success=" . ($this->isSuccessStatusCode($tupple) ? "true" : "false&error=" . $tupple[0]));
        return;
    }

    // Si le statusCode n'est pas 200, il y a eu une erreur et donc on redirige vers la "page principale" des "Modele"
    private function redirectMainPageUtilisateurIfError($tupple){
        if(!$this->isSuccessStatusCode($tupple)){
            header("Location: index.php?page=utilisateurs&action=GET&success=false&error=" . $tupple[0]);
            return;
        }
    }

    public function ctrlInscriptionUtilisateurForm(){
        ob_start();
        require "Views/Inscription/inscription.php";
        $page = ob_get_clean();
        return $page;
    }

    public function ctrlInscriptionUtilisateur($nom, $prenom, $email, $mdp, $confirmMdp, $idRole){
        // On vérifie si les paramètres sont OK sinon on renvoie au formulaire
        if(
            empty($nom) || !is_string($nom) || empty($prenom) || !is_string($prenom) || empty($email) || !is_string($email) || !$this->isUniqueEmail($email) || empty($mdp) || !is_string($mdp) || empty($idRole) || intval($idRole) == 0 || !$this->isValidePassword($mdp) || !($mdp == $confirmMdp)
        ){
            header("Location: index.php?page=inscription&success=false&error=" . parent::STATUSCODE_400);
            return;
        }

        $tupple = $this->createUtilisateur($nom, $prenom, $email, $mdp, $idRole);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }

        if(!$this->isSuccessStatusCode($tupple)){
            header("Location: index.php?page=inscription&success=false&error=" . $tupple[0]);
            return;
        }

        $tupple = $this->connexion($email, $mdp);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }

        if(!$this->isSuccessStatusCode($tupple)){
            header("Location: index.php?page=connexion&success=false&error=" . $tupple[0]);
            return;
        }

        header("Location: index.php?page=categories&action=GET");
        return;
    }

    private function isValidePassword(string $mdp){

        $minuscule = preg_match("/[a-z]/", $mdp);
        $majuscule = preg_match("/[A-Z]/", $mdp);
        $chiffre = preg_match("/[0-9]/", $mdp);
        $caractereSpecial = preg_match("/[^a-zA-Z0-9]/", $mdp);
        $str = strlen($mdp);

        if(!$minuscule || !$majuscule || !$chiffre || !$caractereSpecial || $str < 8){
            return false;
        }

        return true;
    }

    public function ctrlConnexionUtilisateurForm(){
        ob_start();
        require "Views/Connexion/connexion.php";
        $page = ob_get_clean();
        return $page;
    }

    public function ctrlConnexionUtilisateur($email, $mdp){

        if(empty($email) || !is_string($email) || empty($mdp) || !is_string($mdp)){
            header("Location: index.php?page=connexion&success=false&error=" . parent::STATUSCODE_400);
            return;
        }

        $manager = new UtilisateurManager();
        $tupple = $manager->connexion($email, $mdp);
        // Si la constante de DEBUG est à true, on permet un traitement particulier
        if(parent::DEBUG){
            $this->DEBUG($tupple);
        }

        if(!$this->isSuccessStatusCode($tupple)){
            header("Location: index.php?page=connexion&success=false&error=" . parent::STATUSCODE_401);
            return;
        }

        header("Location: index.php?page=categories&action=GET");
        return;
    }

    public function ctrlConnexionToast(){

        if(empty($_SESSION)){
            return;
        }

        ob_start();
        require "Views/Toasts/connexionToast.php";
        $_SESSION['toasted'] = true;
        $page = ob_get_clean();
        return $page;
    }

    public function deconnexion(){
        session_destroy();
        header("Location: index.php?page=connexion");
    }

    public function isAdmin(){
        return $_SESSION['role'] == "admin" || strtoupper($_SESSION['role']) == "GHOST";
    }

    #REGION step

    public function firstStep(){
        setcookie("first_step", "url:'bit.ly/3G4iI5b',content='PurngPbqr',type='Categorie',action='CREATE'");
    }

    public function ctrlfirstStepToast(){
        $_SESSION['step_one'] = null;
        if(!empty($_SESSION['step_one'])){
            return;
        }
        $_SESSION['step_one'] = "success";
        ob_start();
        require "Views/Toasts/firstStepToast.php";
        $page = ob_get_clean();
        $this->firstStep();
        return $page;
    }

    public function verify(){
        $ctrl = new RoleManager();
        $roles = $ctrl->getRoles();
        foreach($roles as $role){
            if(strtoupper($role['nom']) == 'GHOST'){
                $this->thirdStep();
                $this->ctrlthirdStepToast("Bravo, maintenant que vous êtes vous même, aller récupérer votre récompense :)");
            }
        }
        return true;
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

    #ENDREGION

}