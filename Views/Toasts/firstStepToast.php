<div id="toast" aria-live="polite" aria-atomic="true" style="min-height: 200px;">
    <div id="egg" class="toast show" style="position: absolute; bottom: 5%; left: 5%;">
        <div class="toast-header" style="display:flex; justify-content:space-between;">
            <strong class="mr-auto"><?=$_SESSION['prenom'] . " " . $_SESSION['nom'];?></strong>
            <small><?=$_SESSION['role'];?></small>
        </div>
        <div class="toast-body">
            GOOGLE -> Acceptez-vous des petits cookies ? OUI : NON <br>
            IF (reponse == "NON") <br>
            reponse = "OUI";
        </div>
    </div>
</div>

<script>
    document.getElementById('egg').addEventListener('mouseover', () => {
        document.getElementById('egg').style.left = Math.floor(Math.random() * 80) + "%";
        document.getElementById('egg').style.bottom = Math.floor(Math.random() * 80) + "%";
        document.getElementById('egg').style.top = Math.floor(Math.random() * 80) + "%";
        document.getElementById('egg').style.right = Math.floor(Math.random() * 80) + "%";
        document.getElementById('egg').style.height = "150px";
        document.getElementById('egg').style.width = "350px";
    })
</script>