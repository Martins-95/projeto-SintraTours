<?php
// includes/ligacao.php – Ligação à base de dados

$host     = 'localhost';
$dbname   = 'sintra_tours';
$username = 'root';
$password = 'root';        

$conn = new mysqli($host, $username, $password, $dbname);
$conn->set_charset('utf8mb4');

if ($conn->connect_error) {
    die("<p style='color:red;'>Erro de ligação à base de dados: " . $conn->connect_error . "</p>");
}
