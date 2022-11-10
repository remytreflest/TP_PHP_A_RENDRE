<h1 class="title">INDEX UTILISATEURS</h1>
<a class="btn btn-secondary mt-3" href="index.php?page=categories&view=GET">Retour</a>
<a class="mt-3 btn btn-success" href="index.php?page=utilisateurs&action=CREATE">Ajouter un utilisateur</a>
<?php
if(!empty($utilisateurs)){
?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach($utilisateurs as $utilisateur){
            ?>
            <tr>
                <td><?=$utilisateur['nom'];?></td>
                <td><?=$utilisateur['prenom'];?></td>
                <td><?=$utilisateur['email'];?></td>
                <td><?=$utilisateur['role'];?></td>
                <td>
                    <a class="btn btn-warning" href="index.php?page=utilisateurs&action=UPDATE&id=<?=$utilisateur['id_utilisateur'];?>" class="card-link">Modifier</a>
                    <a class="btn btn-danger" href="index.php?page=utilisateurs&action=DELETE&id=<?=$utilisateur["id_utilisateur"];?>" class="card-link">Supprimer</a>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
} else {
    require_once "Views/StatusCode/statusCode204.php";
}

