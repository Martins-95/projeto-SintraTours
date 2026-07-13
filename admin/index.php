<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['user_tipo'] != 'admin'){
    header('Location: ../login.php');
    exit;
}
?>
<?php include '../includes/menu.php'; ?>
<div class="admin-panel">
    <h1>Painel Admin</h1>
    <a href="produtos.php">Produtos</a> | <a href="categorias.php">Categorias</a> | <a href="../logout.php">Logout</a>
</div>

