

<?php
session_start();
require_once('includes/ligacao.php');

if(!isset($_SESSION['user_id'])){
    echo "Precisa de estar logado para finalizar a compra.";
    exit;
}

$user_id = $_SESSION['user_id'];

$conn->query("UPDATE carrinho SET comprado=1, data=NOW() WHERE user_id=$user_id AND comprado=0");

echo "Compra finalizada com sucesso! <a href='index.php'>Voltar à loja</a>";
?>
