<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['user_tipo'] != 'admin') header('Location: ../login.php');
require_once('../includes/ligacao.php');

$id = $_GET['id'];
$res = $conn->query("SELECT * FROM produtos WHERE id=$id");
$produto = $res->fetch_assoc();
?>

<?php include '../includes/menu.php'; ?>

<h2 class="admin-panel-title">Editar Produto</h2>
<form action="editar_produto2.php" method="post" enctype="multipart/form-data" class="add-product-form">
<input type="hidden" name="id" value="<?= $produto['id'] ?>">
Nome: <input type="text" name="nome" value="<?= $produto['nome'] ?>" required><br>
Descrição: <textarea name="descricao"><?= $produto['descricao'] ?></textarea><br>
Preço: <input type="text" name="preco" value="<?= $produto['preco'] ?>" required><br>
Duração: <input type="text" name="duracao" value="<?= htmlspecialchars($produto['duracao'] ?? '') ?>"><br>
Stock: <input type="number" name="stock" value="<?= $produto['stock'] ?>" required><br>
Categoria:
<select name="categoria_id">
<?php
$res_cat = $conn->query("SELECT * FROM categorias");
while($cat = $res_cat->fetch_assoc()){
    $sel = ($cat['id']==$produto['categoria_id'])?'selected':'';
    echo "<option value='".$cat['id']."' $sel>".$cat['nome']."</option>";
}
?>


</select><br>
<br>
Destaque na Página Inicial: <input type="checkbox" name="destaque" value="1" <?= $produto['destaque'] ? 'checked' : '' ?>><br>
Imagem atual:
<?php if($produto['imagem']) echo "<img src='../imagens/".$produto['imagem']."' width='50'>"; ?><br>
Alterar imagem: <input type="file" name="imagem"><br>
<input type="submit" value="Atualizar">
</form>