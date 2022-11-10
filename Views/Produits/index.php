<h1 class="title">INDEX PRODUITS</h1>
<a class="btn btn-secondary mt-3" href="index.php?page=categories&view=GET">Retour</a>
<a class="mt-3 btn btn-success" href="index.php?page=produits&action=CREATE">Ajouter un produit</a>


<?php
if(!empty($produits)){
    ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Prix</th>
                <th scope="col">Quantité</th>
                <th scope="col">Catégorie</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($produits as $produit){
        ?>
        <tr>
            <td><?=$produit['nom'];?></td>
            <td><?=$produit['description'];?></td>
            <td><?=$produit['prix'];?>€</td>
            <td><?=$produit['qte'];?></td>
            <td><?=$produit['categorie'];?></td>
            <td>
                <a class="btn btn-warning" href="index.php?page=produits&action=UPDATE&id=<?=$produit['id_produit'];?>" class="card-link">Modifier</a>
                <a class="btn btn-danger" href="index.php?page=produits&action=DELETE&id=<?=$produit["id_produit"];?>" class="card-link">Supprimer</a>
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
    <div class="alert-alert-warning">Il n'y a aucun produit</div>
    <?php
}






















































if($_SESSION['role'] == Constantes::ROLE_GHOST){
    ?>
    <div class="alert alert-success">Bravo, vous avez terminer le mini-jeu :) !</div>
    <?php
}