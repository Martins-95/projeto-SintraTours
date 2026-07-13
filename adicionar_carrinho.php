<?php
// adicionar_carrinho.php – Adiciona pack ao carrinho e redireciona
session_start();
require_once('includes/ligacao.php');

// Utilizador tem de estar logado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php?login_required=1');
    exit;
}

$user_id = (int)$_SESSION['user_id'];

// Aceita GET (botão rápido) ou POST (formulário com data/quantidade)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produto_id  = (int)$_POST['produto_id'];
    $quantidade  = max(1, (int)$_POST['quantidade']);
    $data_visita = isset($_POST['data_visita']) && $_POST['data_visita'] ? $conn->real_escape_string($_POST['data_visita']) : null;
} else {
    $produto_id  = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $quantidade  = 1;
    $data_visita = null;
}

if ($produto_id <= 0) {
    header('Location: packs.php');
    exit;
}

// Verificar se já existe no carrinho (mesmo produto, não comprado)
$check = $conn->query("SELECT id, quantidade FROM carrinho WHERE user_id=$user_id AND produto_id=$produto_id AND comprado=0");
if ($check && $check->num_rows > 0) {
    $row = $check->fetch_assoc();
    $nova_qty = $row['quantidade'] + $quantidade;
    $id_cart  = (int)$row['id'];
    $conn->query("UPDATE carrinho SET quantidade=$nova_qty WHERE id=$id_cart");
} else {
    $data_sql = $data_visita ? "'$data_visita'" : 'NULL';
    $conn->query("INSERT INTO carrinho (user_id, produto_id, quantidade, data_visita) VALUES ($user_id, $produto_id, $quantidade, $data_sql)");
}

// Redirecionar de volta ao referrer ou ao carrinho
$ref = $_SERVER['HTTP_REFERER'] ?? 'index.php';
// Limpar parâmetros antigos e adicionar confirmação
$ref = preg_replace('/([?&])(added|login_required)=[^&]*/', '', $ref);
$sep = strpos($ref, '?') ? '&' : '?';
header("Location: {$ref}{$sep}added=1");
exit;
