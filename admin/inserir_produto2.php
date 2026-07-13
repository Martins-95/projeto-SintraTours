<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['user_tipo'] != 'admin'){
    header('Location: ../login.php');
    exit;
}
require_once('../includes/ligacao.php');

// Recebe os dados do formulário
$nome = $conn->real_escape_string($_POST['nome']);
$descricao = $conn->real_escape_string($_POST['descricao']);
$preco = (float)$_POST['preco'];
$duracao = $conn->real_escape_string($_POST['duracao']); // NOVO CAMPO para duração do pack
$stock = (int)$_POST['stock'];
$categoria_id = (int)$_POST['categoria_id'];
$destaque = isset($_POST['destaque']) ? 1 : 0; // NOVO CAMPO para destaque na página inicial
$imagem = null;

// Upload da imagem
if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0){
    $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
    $imagem = uniqid().'.'.$ext;
    if(!move_uploaded_file($_FILES['imagem']['tmp_name'], '../imagens/'.$imagem)){
        die("<p style='color:red;'>Falha no upload da imagem.</p>");
    }
}

// Inserção na base de dados
$sql = "INSERT INTO produtos (nome, descricao, preco, duracao, stock, categoria_id, imagem, destaque)
        VALUES ('$nome','$descricao',$preco,'$duracao',$stock,$categoria_id,'$imagem',$destaque)";

if($conn->query($sql) === TRUE){
    echo "<p style='color:green;'>Produto adicionado com sucesso. <a href='produtos.php'>Voltar</a></p>";
}else{
    echo "<p style='color:red;'>Erro ao adicionar produto: ".$conn->error."</p>";
    echo "<pre>Query: $sql</pre>";
}
?>