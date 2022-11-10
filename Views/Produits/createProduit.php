<h1 class="title">CREATE PRODUIT</h1>
<a class="btn btn-secondary mt-3" href="index.php?page=produits&view=GET">Retour</a>

<div class="card mt-3">
    <div class="card-header">
        <h5>Ajouter un produit</h5>
    </div>
    <div class="card-body">
        <form action="index.php?page=produits&action=CREATE" method="POST">
            <div class="form-group mt-3">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" class="form-control" id="nom" placeholder="Ex : Omega" />
            </div>
            <div class="form-group mt-3">
                <label for="description">Description :</label>
                <input type="text" name="description" class="form-control" id="description" placeholder="Ex : Omega" />
            </div>
            <div class="form-group mt-3">
                <label for="prix">Prix :</label>
                <input type="number" step='0.01' class="form-control" name="prix" id="prix" placeholder="Ex : 1789" />
            </div>
            <div class="form-group mt-3">
                <label for="qte">Quantité :</label>
                <input type="number" step='1' class="form-control" name="qte" id="qte" placeholder="Ex : 1" />
            </div>
            <div class="form-group mt-3">
                <label for="id_categorie">Marque : </label>
                <select name="id_categorie" class="form-control" id="id_categorie">
                    <?php
                    foreach($categories as $categorie){
                        ?>
                        <option value="<?=$categorie['id_categorie'];?>"><?=$categorie['nom'];?></option>
                        <?php
                    }
                ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success mt-3">Ajouter</button>
        </form>
    </div>
</div>