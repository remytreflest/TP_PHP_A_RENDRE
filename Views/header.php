<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="Assets/css/styles.css">
        <script src="https://kit.fontawesome.com/4cdad7a7dc.js" crossorigin="anonymous"></script>

        <title>LA GROSSE BOUTIQUE</title>
    </head>

    <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" style="padding-left:15px;" href="#">LA GROSSE BOUTIQUE !</a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?page=deconnexion">Deconnexion</a>
                    <a class="nav-link" href="index.php?page=categories&action=GET&bonus=start-game">Start a game ?</a>
                </li>
            </ul>
        </div>
    </nav>

    <div id="main-container" class="main-container">
