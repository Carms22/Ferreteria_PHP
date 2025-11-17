<nav class="row">
    <a href="index.php?page=maintenance">Mantenimiento</a>
    <a href="index.php?page=catalog/landing">Suministros</a>
    <a href="index.php?page=order">Pedido</a>
    <a href="index.php?page=auth/logout">Cerrar sesión</a>
    <h4><?php if(isset($_SESSION['user_email'])){
        echo $_SESSION['user_email'];
    } ?>

    </h4>
</nav>