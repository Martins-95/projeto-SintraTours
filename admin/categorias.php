<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['user_tipo'] != 'admin') header('Location: ../login.php');
require_once('../includes/ligacao.php');


// Inserir nova categoria
if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
    $conn->query("INSERT INTO categorias (nome) VALUES ('$nome')");
}

// Apagar categoria
if(isset($_GET['apagar'])){
    $id = $_GET['apagar'];
    $conn->query("DELETE FROM categorias WHERE id=$id");
}

$res = $conn->query("SELECT * FROM categorias");
?>

<?php include '../includes/menu.php'; ?>

<h2 class="admin-panel-title">Categorias</h2>

<form method="post" class="add-category-form">
Nova Categoria: <input type="text" name="nome" required>
<input type="submit" value="Adicionar" class="btn">
</form>

<table border="1" class="classes-table">
<tr><th>ID</th><th>Nome</th><th>Ações</th></tr>
<?php while($cat=$res->fetch_assoc()): ?>
<tr>
<td><?= $cat['id'] ?></td>
<td><?= $cat['nome'] ?></td>
<td><a href="?apagar=<?= $cat['id'] ?>">Apagar</a></td>
</tr>
<?php endwhile; ?>
</table>