<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['user_tipo'] != 'admin') header('Location: ../login.php');
require_once('../includes/ligacao.php');

$id = $_POST['id'];
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];
$duracao = $conn->real_escape_string($_POST['duracao']);
$stock = $_POST['stock'];
$categoria_id = $_POST['categoria_id'];
$destaque = isset($_POST['destaque']) ? 1 : 0;

$imagem = null;
if(isset($_FILES['imagem']) && $_FILES['imagem']['error']==0){
    $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
    $imagem = uniqid().'.'.$ext;
    move_uploaded_file($_FILES['imagem']['tmp_name'], '../imagens/'.$imagem);
    
    $sql = "UPDATE produtos SET nome='$nome', descricao='$descricao', preco='$preco', duracao='$duracao', stock='$stock', categoria_id='$categoria_id', imagem='$imagem', destaque='$destaque' WHERE id=$id";
}else{
    $sql = "UPDATE produtos SET nome='$nome', descricao='$descricao', preco='$preco', duracao='$duracao', stock='$stock', categoria_id='$categoria_id', destaque='$destaque' WHERE id=$id";
}

if($conn->query($sql)===TRUE){
    echo "Produto atualizado com sucesso. <a href='produtos.php'>Voltar</a>";
}else{
    echo "Erro: ".$conn->error;
}
?>