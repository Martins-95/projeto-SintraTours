<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['user_tipo'] != 'admin') header('Location: ../login.php');
require_once('../includes/ligacao.php');

$id = $_GET['id'];

// Primeiro, eliminar as referências no carrinho. Eu não conseguia eliminar o produto por causa das chaves estrangeiras, então tive que eliminar as entradas do carrinho primeiro.
$conn->query("DELETE FROM carrinho WHERE produto_id=$id");

// Depois, eliminar o produto
$sql = "DELETE FROM produtos WHERE id=$id";
if($conn->query($sql)===TRUE){
    echo "Produto eliminado com sucesso. <a href='produtos.php'>Voltar</a>";
}else{
    echo "Erro: ".$conn->error;
}
?>