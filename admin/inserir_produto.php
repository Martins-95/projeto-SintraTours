<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['user_tipo'] != 'admin') header('Location: ../login.php');
require_once('../includes/ligacao.php');
?>

<?php include '../includes/menu.php'; ?>

<h2 class="admin-panel-title">Adicionar Produto</h2>
<form action="inserir_produto2.php" method="post" enctype="multipart/form-data" class="add-product-form">
Nome: <input type="text" name="nome" required><br>
Descrição: <textarea name="descricao"></textarea><br>
Preço: <input type="text" name="preco" required><br>
Duração: <input type="text" name="duracao" placeholder="ex: 1 dia, Meio dia"><br>
Stock: <input type="number" name="stock" required><br>
Categoria: 
<select name="categoria_id">
<?php
$res = $conn->query("SELECT * FROM categorias");
while($cat = $res->fetch_assoc()){
    echo "<option value='".$cat['id']."'>".$cat['nome']."</option>";
}
?>
</select><br>
Destaque na Página Inicial: <input type="checkbox" name="destaque" value="1"><br>
Imagem: <input type="file" name="imagem"><br>
<input type="submit" value="Adicionar">
</form>