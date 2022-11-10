<?php
if(isset($_GET['error']) && !empty($_GET['error']) && $_GET['error'] == BDD::STATUSCODE_401){
    require "Views/StatusCode/statusCode401.php";
}
?>

<h1 class="title">CONNEXION</h1>

<div class="container mt-5 d-flex flex-column align-items-center">
    <h1>Connexion</h1>
    <form method="POST" action="index.php?page=connexion" class="needs-validation" novalidate>

        <div class="form-group my-4">
            <input type="email" class="form-control" name="email" id="email" placeholder="Ex : remy.treflest@yopmail.com">
        </div>

        <div class="form-group my-4">
            <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Azerty123* -> oO'">
        </div>

        <div class="form-group text-center mt-4">
            <button type="submit" class="btn form-btn" name="submit" value="ON">Connexion</button>
            <a class="btn form-btn" href="index.php?page=inscription">S'inscrire</a>
        </div>
    </form>
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>