<!-- Sidebar-->
<?php
session_start();
?>

<div class="border-end bg-white" id="sidebar-wrapper" style="background-color: #5c50e0;">
    <div class="sidebar-heading border-bottom" style="background-color: #5c50e0;">Barbearia </div>
    <div class="list-group list-group-flush">
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="users.php"><i class="fa fa-user" aria-hidden="true"></i> Usuários</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="Clients.php"><i class="fa fa-users" aria-hidden="true"></i> Clientes</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3 flut" href="services.php"><i class="fa fa-scissors" aria-hidden="true"></i> Serviços</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="schedules.php"><i class="fa fa-calendar" aria-hidden="true"></i> Agenda</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="profile.php"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Meu Perfil</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="../index.html" onclick="logOut()"> <i class="fa fa-sign-out" aria-hidden="true"></i> <?php 
        print($_SESSION['nome']);?></a>
    </div>
</div>

<?php
    
    if (!$_SESSION['login']) {
        session_destroy();
        header('location: http://localhost/barbearia/index.html');
    }
?>