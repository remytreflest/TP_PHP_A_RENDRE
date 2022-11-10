<?php
require_once "Views/header.php";
require_once "Class/Autoload.php";
Autoload::load();

if(isset($_GET['success']) && !empty($_GET['success']) && $_GET['success'] == "true"){
    BDD::requireErrorView(Constantes::STATUSCODE_200);
}

if(isset($_GET['success']) && !empty($_GET['success']) && $_GET['success'] == "false" && !empty($_GET['error'])){
    BDD::requireErrorView($_GET['error']);
}

if(isset($_GET['page'])){

    
    $userController = new UtilisateurController();

    switch ($_GET['page']) {

        case 'categories':

            if(isset($_GET['action']) && !empty($_GET['action'])){
                $controller = new CategorieController();
                switch ($_GET['action']){
                    case 'CREATE':
                        if($userController->isAdmin()){
                            if(isset($_POST) && !empty($_POST)){
                                echo $controller->ctrlCreateCategorie($_POST['nom']);
                            } else {
                                echo $controller->ctrlCreateCategorieForm();
                            }
                        }
                        break;
                    case 'UPDATE':
                        if($userController->isAdmin()){

                            if(isset($_POST) && !empty($_POST)){
                                echo $controller->ctrlUpdateCategorie($_POST['id'], $_POST['nom']);
                            } 
                            else if(isset($_GET['id']) && !empty($_GET['id'])){
                                echo $controller->ctrlUpdateCategorieForm($_GET['id']);
                            } 
                            else {
                                header("Location: index.php?page=categories&action=GET");
                            }
                        }
                        break;
                    case 'DELETE':
                        if($userController->isAdmin()){
                            if(isset($_GET['id']) && !empty($_GET['id'])){
                                echo $controller->ctrlDeleteCategorie($_GET['id']);
                            } else {
                                header("Location: index.php?page=categories&action=GET");
                            }
                        }
                        break;
                    default:
                        echo $controller->ctrlGetCategories();
                        if(isset($_GET['bonus']) && !empty($_GET['bonus']) && $_GET['bonus'] == "start-game"){
                            echo $userController->ctrlfirstStepToast();
                        }
                        if(isset($_GET['bonus']) && !empty($_GET['bonus']) && $_GET['bonus'] == "step-two"){
                            echo $controller->ctrlsecondStepToast("Bravo, c'est un bon début");
                        }
                        break;
                }
            } else {
                header("Location: index.php?page=categories&action=GET");
            }
            break;


        case 'categorie-produits':
            if(isset($_GET['id']) && !empty($_GET['id'])){
                $controller = new ProduitController();
                echo $controller->ctrlGetProduitsByCategorie($_GET['id']);
            }
            break;


        case 'produits':
            
            if(isset($_GET['action']) && !empty($_GET['action'])){
                $controller = new ProduitController();
                switch ($_GET['action']){
                    case 'CREATE':
                        if($userController->isAdmin()){
                            if(isset($_POST) && !empty($_POST)){
                                echo $controller->ctrlCreateProduit($_POST['nom'], $_POST['description'], $_POST['prix'], $_POST['qte'], $_POST['id_categorie']);
                            } else {
                                echo $controller->ctrlCreateProduitForm();
                            }
                        }
                        break;
                    case 'UPDATE':
                        if($userController->isAdmin()){

                            if(isset($_POST) && !empty($_POST)){
                                echo $controller->ctrlUpdateProduit($_POST['id'], $_POST['nom'], $_POST['description'], $_POST['prix'], $_POST['qte'], $_POST['id_categorie']);
                            } 
                            else if(isset($_GET['id']) && !empty($_GET['id'])){
                                echo $controller->ctrlUpdateProduitForm($_GET['id']);
                            } 
                            else {
                                header("Location: index.php?page=produits&action=GET");
                            }
                        }
                        break;
                    case 'DELETE':
                        if($userController->isAdmin()){
                            if(isset($_GET['id']) && !empty($_GET['id'])){
                                echo $controller->ctrlDeleteProduit($_GET['id']);
                            } else {
                                header("Location: index.php?page=produits&action=GET");
                            }
                        }
                        break;
                    default:
                        if($userController->isAdmin()){
                            echo $controller->ctrlGetProduits();
                        }
                        if(isset($_GET['bonus']) && !empty($_GET['bonus']) && $_GET['bonus'] == "step-three"){
                            $controller = new ProduitController();
                            echo $controller->ctrlthirdStepToast("Bravo, vous y êtes presque, on change un peu le principe <br> En tant que développeur, on a tendence à dire que le <b>problème</b> de l'utilisateur se situe 'entre la chaise et le clavier', ici c'est le contraire. VOUS êtes la solution. Si vous ne me croyez pas, ajoutez vous ;)");
                        }
                        break;
                }
            } else {
                header("Location: index.php?page=produits&action=GET");
            }
            break;


        case "utilisateurs" :
            if(isset($_GET['action']) && !empty($_GET['action'])){
                $controller = new UtilisateurController();
                switch ($_GET['action']){
                    case 'CREATE':
                        if($userController->isAdmin()){
                            if(isset($_POST) && !empty($_POST)){
                                echo $controller->ctrlCreateUtilisateur($_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['mdp'], $_POST['id_role']);
                            } else {
                                echo $controller->ctrlCreateUtilisateurForm();
                            }
                        }
                        break;
                    case 'UPDATE':
                        if($userController->isAdmin()){

                            if(isset($_POST) && !empty($_POST)){
                                echo $controller->ctrlUpdateUtilisateur($_POST['prenom'], $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp'], $_POST['id_role']);
                            } 
                            else if(isset($_GET['id']) && !empty($_GET['id'])) {
                                echo $controller->ctrlUpdateUtilisateurForm($_GET['id']);
                            } 
                            else {
                                header("Location: index.php?page=utilisateurs&action=GET");
                            }
                        }
                        break;
                    case 'DELETE':
                        if($userController->isAdmin()){
                            if(isset($_GET['id']) && !empty($_GET['id'])){
                                echo $controller->ctrlDeleteUtilisateur($_GET['id']);
                            } else {
                                header("Location: index.php?page=utilisateurs&action=GET");
                            }
                        }
                        break;
                    default:
                        if($userController->isAdmin()){
                            echo $controller->ctrlGetUtilisateurs();
                        }
                        break;
                }
            } else {
                header("Location: index.php?page=utilisateurs&action=GET");
            }
            break;

        case "connexion" :
            // Si l'utilisateur est déjà connecté, on le renvoie vers la page d'accueil
            if(!empty($_SESSION)){
                header("Location: index.php?page=utilisateurs&action=GET");
            }
            $controller = new UtilisateurController();
            if(isset($_POST) && !empty($_POST)){
                echo $controller->ctrlConnexionUtilisateur($_POST['email'], $_POST['mdp']);
            } else {
                echo $controller->ctrlConnexionUtilisateurForm();
            }
            break;


        case "inscription" :
            // Si l'utilisateur est déjà connecté, on le renvoie vers la page d'accueil
            if(!empty($_SESSION)){
                header("Location: index.php?page=utilisateurs&action=GET");
            }
            $controller = new UtilisateurController();
            if(isset($_POST) && !empty($_POST)){
                echo $controller->ctrlInscriptionUtilisateur($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp'], $_POST['confirmMdp'], Constantes::ROLE_UTILISATEUR);
            } else {
                echo $controller->ctrlInscriptionUtilisateurForm();
            }
            break;

        case "deconnexion" :
            $controller = new UtilisateurController();
            $controller->deconnexion();
            break;

        case "error" :
            echo "<p>ERREUR CRITIQUE !</p>";
            break;

        default:
            header("Location: index.php?page=categories&action=GET");
            break;
    }
} else {
    if(!empty($_SESSION['FK_id_role'])){
        header("Location: index.php?page=utilisateurs&action=GET");
    }else {
        header("Location: index.php?page=connexion");
    }
}


if(isset($_GET['bonus']) && !empty($_GET['bonus']) && $_GET['bonus'] == "start-game"){
    ?>
<script>
document.getElementById("main-container").style.background = "no-repeat center/80% url('Assets/img/saw.jpg');"
</script>
<?php

}
require_once "Views/footer.php";