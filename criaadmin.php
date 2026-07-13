<?php
require_once('includes/ligacao.php');

$nome = 'Admin';
$email = 'admin@loja.com';
$senha = password_hash('1234', PASSWORD_DEFAULT);
$tipo = 'admin';

$sql = "INSERT INTO utilizadores (nome, email, senha, tipo) VALUES ('$nome','$email','$senha','$tipo')";

if($conn->query($sql) === TRUE){
    echo "Admin criado com sucesso!";
}else{
    echo "Erro: ".$conn->error;
}
?>