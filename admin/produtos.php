<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['user_tipo'] != 'admin'){
    header('Location: ../login.php');
    exit;
}
require_once('../includes/ligacao.php');
require_once('../includes/menu.php');

// Query para listar produtos e categorias
$sql = "SELECT p.*, c.nome as categoria FROM produtos p LEFT JOIN categorias c ON p.categoria_id=c.id";
$res = $conn->query($sql);

if(!$res){
    die("Erro na query: ".$conn->error);
}
?>

<h2 class="admin-panel-title">Lista de Produtos</h2>
<div class="btn-add-product"><a href="inserir_produto.php" >Adicionar Produto</a></div>
<?php if($res->num_rows == 0): ?>
    <p>Nenhum produto encontrado.</p>
<?php else: ?>
<table class="produtos-table" align="center">
<tr><th>ID</th><th>Nome</th><th>Preço</th><th>Stock</th><th>Categoria</th><th>Ações</th></tr>
<?php while($row = $res->fetch_assoc()): ?>
<tr>
<td><?= $row['id'] ?></td>
<td><?= htmlspecialchars($row['nome']) ?></td>
<td><?= number_format($row['preco'], 2, ',', '.') ?> €</td>
<td><?= (int)$row['stock'] ?></td>
<td><?= htmlspecialchars($row['categoria']) ?></td>
<td>
    <a href="editar_produto.php?id=<?= $row['id'] ?>">Editar</a> |
    <a href="eliminar_produto.php?id=<?= $row['id'] ?>" onclick="return confirm('Tem a certeza que quer eliminar este produto?')">Eliminar</a>
</td>
</tr>
<?php endwhile; ?>
</table>
<?php endif; ?>