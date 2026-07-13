<?php
session_start();
require_once('includes/ligacao.php');

// Verifica se o utilizador está logado
if(!isset($_SESSION['user_id'])){
    echo "Precisa de iniciar sessão para ver o carrinho.";
    exit;
}

$user_id = (int)$_SESSION['user_id'];

// Remover produto
if(isset($_POST['remover'])){
    $id = (int)$_POST['carrinho_id'];
    $conn->query("DELETE FROM carrinho WHERE id=$id AND user_id=$user_id AND comprado=0");
    // Redirecionar para atualizar a página
    header("Location: carrinho.php");
    exit;
}

// Buscar produtos do carrinho
$res = $conn->query("
    SELECT c.id as carrinho_id, p.nome, p.preco, c.quantidade
    FROM carrinho c
    JOIN produtos p ON c.produto_id = p.id
    WHERE c.user_id=$user_id AND c.comprado=0
");

$total = 0;
?>

<?php include 'includes/menu.php'; ?>

<div class="inner-page-hero">
    <h2 >Meu Carrinho</h2>
    <a href="index.php" class="btn">Continuar a Comprar</a>
</div>

<?php if($res->num_rows == 0): ?>
    <p align="center">O seu carrinho está vazio.</p>
<?php else: ?>
    <table class="carrinho-table" align="center">
        <tr>
            <th>Produto</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Ação</th>
        </tr>
        <?php while($c = $res->fetch_assoc()): 
            $total += $c['preco'] * $c['quantidade'];
        ?>
        <tr>
            <td><?= htmlspecialchars($c['nome']) ?></td>
            <td><?= number_format($c['preco'], 2, ',', '.') ?> €</td>
            <td><?= (int)$c['quantidade'] ?></td>
            <td>
                <form method="post" style="margin:0;">
                    <input type="hidden" name="carrinho_id" value="<?= $c['carrinho_id'] ?>">
                    <button type="submit" name="remover" class="btn">Remover</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <p><strong>Total: <?= number_format($total, 2, ',', '.') ?> €</strong></p>
    <div class="carrinho-cta">
        <a href="finalizar_compra.php" class="btn">Finalizar Compra</a>
    </div>
<?php endif; ?>

