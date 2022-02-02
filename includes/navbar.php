<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container-fluid">
        <button class="btn" style="background-color: #5c50e0;" id="sidebarToggle"><strong>Menu</strong></button>
        <?php
            
            
            

            if (!$_SESSION['login']) {
                session_destroy();
                header('location: http://localhost/barbearia/index.html');
                
            }
        ?>
    </div>
</nav>
<!-- Page content-->
<div class="fundo">
    <img class="fundo" src="../img/Fundo.png" alt="Plano de fundo">
</div>