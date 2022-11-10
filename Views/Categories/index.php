<h1 class="title">INDEX CATEGORIES</h1>
<?php
$ctrl = new UtilisateurController();
if($ctrl->isAdmin()){
?>
    <a class="mt-3 btn btn-success" href="index.php?page=categories&action=CREATE">Ajouter une categorie</a>
    <a class="mt-3 btn btn-info" href="index.php?page=produits&action=GET">Gestion des produits</a>
    <a class="mt-3 btn btn-primary" href="index.php?page=utilisateurs&action=GET">Gestion des utilisateurs</a>
<?php
}
?>
<?php


if(!empty($categories)){
    ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Catégorie</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($categories as $categorie){
        ?>
        <tr>
            <td><?=$categorie['nom'];?></td>
            <td>
                <?php
                if($_SESSION['FK_id_role'] == 2){
                ?>
                    <a class="btn btn-secondary" href="index.php?page=categorie-produits&id=<?=$categorie["id_categorie"];?>" class="card-link">Produits associés</a>
                    <a class="btn btn-warning" href="index.php?page=categories&action=UPDATE&id=<?=$categorie["id_categorie"];?>" class="card-link">Modifier</a>
                    <a class="btn btn-danger" href="index.php?page=categories&action=DELETE&id=<?=$categorie["id_categorie"];?>" class="card-link">Supprimer</a>
                <?php
                }
                ?>
            </td>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
<?php
} else {
    ?>
    <div class="alert-alert-warning">Il n'y a aucune categorie</div>
    <?php
}