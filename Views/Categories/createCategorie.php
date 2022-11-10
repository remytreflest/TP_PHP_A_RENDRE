<h1 class="title">CREATE CATEGORIE</h1>
<a class="btn btn-secondary mt-3" href="index.php?page=categories&action=GET">Retour</a>

<div class="card mt-3">
    <div class="card-header">
        <h5>Ajouter une categorie</h5>
    </div>
    <div class="card-body">
        <form action="index.php?page=categories&action=CREATE" method="POST">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" class="form-control mt-3" name="nom" id="nom" placeholder="Ex : Omega" />
                <button type="submit" class="btn btn-success mt-3">Ajouter</button>
            </div>
        </form>
    </div>
</div>