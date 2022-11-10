<div id="toast" aria-live="polite" aria-atomic="true" style="min-height: 200px;">
    <div  class="toast show" style="position: absolute; bottom: 5%; left: 5%;">
        <div class="toast-header" style="display:flex; justify-content:space-between;">
            <strong class="mr-auto"><?=$_SESSION['prenom'] . " " . $_SESSION['nom'];?></strong>
            <small><?=$_SESSION['role'];?></small>
        </div>
        <div class="toast-body">
            <?=$text;?>
        </div>
    </div>
</div>

<script>
    document.getElementById('toast').addEventListener('click', () => {
        document.getElementById('toast').style.display = "none";
    })

    if(document.getElementById('egg') != null){
        document.getElementById('egg').style.display = "none";
    }
</script>