<h1 class="title">UPDATE CATEGORIES</h1>
<a class="btn btn-secondary mt-3" href="index.php?page=categories&action=GET">Retour</a>

<?php
if(!empty($categorie)){
?>
    <div class="card mt-3">
        <div class="card-header">
            <h5>Mettre à jour la categorie <?=$categorie['nom'];?></h5>
        </div>
        <div class="card-body">
            <form action="index.php?page=categories&action=UPDATE" method="POST">
                <div class="form-group">
                    <label for="nom">Nouveau nom :</label>
                    <input type="text" class="form-control mt-3" name="nom" id="nom" value="<?=$categorie['nom'];?>" />
                </div>
                <input type="hidden" name="id" id="id" value="<?=$categorie['id_categorie'];?>" />
                <button type="submit" class="btn btn-warning mt-3">Modifier</button>
            </form>
        </div>
    </div>
<?php
} else {
    ?>
    <div class="alert alert-warning">categorie non trouvée pour une mise à jour.</div>
    <?php
}