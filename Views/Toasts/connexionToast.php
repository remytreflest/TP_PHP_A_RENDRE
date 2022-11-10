<div id="toast" aria-live="polite" aria-atomic="true" style="min-height: 200px;">
    <div  class="toast show" style="position: absolute; bottom: 5%; left: 5%;">
        <div class="toast-header" style="display:flex; justify-content:space-between;">
            <strong class="mr-auto"><?=$_SESSION['prenom'] . " " . $_SESSION['nom'];?></strong>
            <small><?=$_SESSION['role'];?></small>
        </div>
        <div class="toast-body">
            <?php
            if($_SESSION['FK_id_role'] == 1){
                echo "Vous êtes connecté en temps qu'UTILISATEUR et n'avez droit à RIEN !";
            }
            else if ($_SESSION['FK_id_role'] == 2){
                echo "Vous êtes connecté en temps qu'ADMIN et avez tous les droits";
            }
            ?>
        </div>
    </div>
</div>

<script>
    document.getElementById('toast').addEventListener('click', () => {
        document.getElementById('toast').style.display = "none";
    })
</script>