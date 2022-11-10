<h1 class="title">INSCRIPTION UTILISATEUR</h1>
<a class="btn btn-secondary mt-3" href="index.php?page=connexion">Retour à la connexion</a>

<div class="card mt-3">
    <div class="card-header">
        <h5>Inscription</h5>
    </div>
    <div class="card-body">
        <form action="index.php?page=inscription" method="POST">
            <div class="form-group mt-3">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" class="form-control" id="nom" placeholder="Ex : Alpha" required/>
            </div>
            <div class="form-group mt-3">
                <label for="prenom">Prenom :</label>
                <input type="text" name="prenom" class="form-control" id="prenom" placeholder="Ex : Omega" required/>
            </div>
            <div class="form-group mt-3">
                <label for="email">Email :</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Ex : remy.treflest@hotmail.fr" required/>
            </div>
            <div class="form-group mt-3">
                <label for="mdp">Mot de passe :</label>
                <input type="password" step='1' class="form-control" name="mdp" id="mdp" placeholder="Ex : Azerty123*" required/>
                <div id="msg"></div>
                <div class="">Le mot de passe doit contenir au minimum, 1 minuscule, 1 majuscule, 1 caractère spécial, 1 chiffre et comprendre au moins 8 caractères</div>
            </div>
            <div class="form-group mt-3">
                <label for="confirmMdp">Confirmer mot de passe :</label>
                <input type="password" step='1' class="form-control" name="confirmMdp" id="confirmMdp" placeholder="Ex : 1" required/>
            </div>
            <button id="submit" type="submit" class="btn btn-success mt-3">Créer un compte</button>
        </form>
    </div>
</div>

<script type="text/javascript"> 

    let input = document.getElementById("mdp");
    let form = document.querySelector("form");

    input.addEventListener('input', () => {
        var str = input.value; 
        if (str.match( /[0-9]/g) && 
                str.match( /[A-Z]/g) && 
                str.match(/[a-z]/g) && 
                str.match( /[^a-zA-Z\d]/g) &&
                str.length >= 8) 
            msg = "<p style='color:green'>Mot de passe fort.</p>"; 
        else 
            msg = "<p style='color:red'>Mot de passe trop faible.</p>"; 
        document.getElementById("msg").innerHTML= msg; 
    });

</script> 