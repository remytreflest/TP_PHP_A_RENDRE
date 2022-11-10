<h1 class="title">LISTE PRODUIT PAR CATEGORIE</h1>
<a class="btn btn-secondary mt-3" href="index.php?page=categories&action=GET">Retour</a>
<?php

if(!empty($produits)){
    foreach($produits as $produit){
    ?>
    <div class="card mt-3">
        <div class="card-body">
            <p>Nom du modèle : <?=$produit['nom'];?></p>
            <p>Description : <?=$produit['description'];?></p>
            <p>Prix : <?=$produit['prix'];?>€</p>
            <p>Quantité : <?=$produit['qte'];?></p>
            <p>Id de la categorie : <?=$produit['FK_id_categorie'];?></p>
        </div>
    </div>
    <?php
    }
} else {
    ?>
    <div class="alert-alert-warning">Il n'y a aucune categorie</div>
    <?php
}
