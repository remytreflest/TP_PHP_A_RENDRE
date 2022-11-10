<h1 class="title">UPDATE PRODUIT</h1>
<a class="btn btn-secondary mt-3" href="index.php?page=produits&view=GET">Retour</a>

<div class="card mt-3">
    <div class="card-header">
        <h5>Ajouter un produit</h5>
    </div>
    <div class="card-body mt-3">
        <form action="index.php?page=produits&action=UPDATE" method="POST">
            <input type="hidden" name="id" value="<?=$produit['id_produit'];?>">
            <div class="form-group mt-3">
                <label for="nom">Nom :</label>
                <input type="text" class="form-control" name="nom" id="nom" value="<?=$produit['nom'];?>" />
            </div>
            <div class="form-group mt-3">
                <label for="description">Description :</label>
                <input type="text" name="description" class="form-control" id="description" value="<?=$produit['description'];?>" />
            </div>
            <div class="form-group mt-3">
                <label for="prix">Prix :</label>
                <input type="number" class="form-control" step='0.01' name="prix" id="prix" value="<?=$produit['prix'];?>" />
            </div>
            <div class="form-group mt-3">
                <label for="qte">Quantité :</label>
                <input type="number" step='1' class="form-control" name="qte" id="qte" value="<?=$produit['qte'];?>" />
            </div>
            <div class="form-group mt-3">
                <label for="id_categorie">Marque : </label>
                <select name="id_categorie" class="form-control" id="id_categorie">
                    <?php
                    foreach($categories as $cat){
                        ?>
                        <option value="<?=$cat['id_categorie'];?>" <?=$produit['FK_id_categorie'] == $cat['id_categorie'] ? "selected" : "";?>><?=$cat['nom'];?></option>
                        <?php
                    }
                ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success mt-3">Modifier</button>
        </form>
    </div>
</div>