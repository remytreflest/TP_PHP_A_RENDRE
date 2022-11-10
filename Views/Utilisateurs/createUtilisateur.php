<h1 class="title">CREATE UTILISATEUR</h1>
<a class="btn btn-secondary mt-3" href="index.php?page=utilisateurs&view=GET">Retour</a>

<div class="card mt-3">
    <div class="card-header">
        <h5>Ajouter un utilisateur</h5>
    </div>
    <div class="card-body">
        <form action="index.php?page=utilisateurs&action=CREATE" method="POST">
            <div class="form-group mt-3">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" class="form-control" id="nom" placeholder="Ex : Alpha" />
            </div>
            <div class="form-group mt-3">
                <label for="prenom">Prenom :</label>
                <input type="text" name="prenom" class="form-control" id="prenom" placeholder="Ex : Omega" />
            </div>
            <div class="form-group mt-3">
                <label for="email">Email :</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Ex : remy.treflest@yopmail.com" />
            </div>
            <div class="form-group mt-3">
                <label for="mdp">Mot de passe :</label>
                <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Ex : Azerty123*" />
            </div>
            <div class="form-group mt-3">
                <label for="id_role">Role : </label>
                <select name="id_role" class="form-control" id="id_role">
                    <?php
                    foreach($roles as $role){
                        ?>
                        <option value="<?=$role['id_role'];?>"><?=$role['nom'];?></option>
                        <?php
                    }
                ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success mt-3">Ajouter</button>
        </form>
    </div>
</div>