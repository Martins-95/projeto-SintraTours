<?php
session_start();
require_once('includes/ligacao.php');

// Verifica se a categoria foi enviada
if(!isset($_GET['categoria'])){
    echo "Categoria não selecionada.";
    exit;
}

$categoria_id = (int) $_GET['categoria'];

// Consulta produtos da categoria
$res = $conn->query("SELECT * FROM produtos WHERE categoria_id=$categoria_id");

if(!$res){
    die("Erro na query: " . $conn->error);
}

// Processa adição ao carrinho
if(isset($_POST['add_carrinho'])){
    if(!isset($_SESSION['user_id'])){
        echo "<p style='color:red;'>Precisa de iniciar sessão para adicionar ao carrinho.</p>";
    } else {
        $produto_id = (int) $_POST['produto_id'];
        $user_id = $_SESSION['user_id'];
        $sql_add = "INSERT INTO carrinho (user_id, produto_id, quantidade) VALUES ($user_id, $produto_id, 1)";
        if($conn->query($sql_add)){
            echo "<p style='color:green;'>Produto adicionado ao carrinho!</p>";
        } else {
            echo "<p style='color:red;'>Erro: " . $conn->error . "</p>";
        }
    }
}
?>
<?php include 'includes/menu.php'; ?>
<h2>Produtos</h2>
<a href="index.php">Voltar</a>

<?php if($res->num_rows == 0): ?>
    <p>Nenhum produto nesta categoria.</p>
<?php else: ?>
<form method="post">
<table border="1">
<tr><th>Nome</th><th>Preço</th><th>Stock</th><th>Ação</th></tr>
<?php while($p = $res->fetch_assoc()): ?>
<tr>
<td><?= htmlspecialchars($p['nome']) ?></td>
<td><?= number_format($p['preco'],2,",",".") ?> €</td>
<td><?= (int)$p['stock'] ?></td>
<td>
<input type="hidden" name="produto_id" value="<?= $p['id'] ?>">
<button type="submit" name="add_carrinho">Adicionar ao Carrinho</button>
</td>
</tr>
<?php endwhile; ?>
</table>
</form>
<?php endif; ?>