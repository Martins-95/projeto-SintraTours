<?php
// includes/menu.php – Cabeçalho partilhado
// Determina o prefixo de path (admin/ precisa de ../)
$prefix = (strpos($_SERVER['PHP_SELF'], '/admin/') !== false) ? '../' : '';
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= $prefix ?>includes/css/style.css">
    <link rel="shortcut icon" href="<?= $prefix ?>Imagens/logo.png" type="image/x-icon">
    <title><?= isset($page_title) ? htmlspecialchars($page_title) . ' – ' : '' ?>Sintra Tour's</title>
</head>
<body>
<header>
    <a href="<?= $prefix ?>index.php">
        <img id="header-img" src="<?= $prefix ?>Imagens/Palacio-da-Pena-Logo.webp" alt="Sintra Tour Logo">
    </a>
    <nav>
        <ul>
            <?php if (strpos($_SERVER['PHP_SELF'], '/admin/') !== false): ?>
                <li><a href="<?= $prefix ?>admin/index.php"><i class="fas fa-tachometer-alt"></i> Painel</a></li>
                <li><a href="<?= $prefix ?>admin/produtos.php"><i class="fas fa-box"></i> Packs</a></li>
                <li><a href="<?= $prefix ?>admin/categorias.php"><i class="fas fa-tags"></i> Categorias</a></li>
                <li><a href="<?= $prefix ?>logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
            <?php else: ?>
                <li><a href="<?= $prefix ?>index.php#about"><i class="fas fa-info-circle"></i> Sobre</a></li>
                <li><a href="<?= $prefix ?>index.php#packs"><i class="fas fa-map-marked-alt"></i> Packs</a></li>
                <li><a href="<?= $prefix ?>index.php#testemunhos"><i class="fas fa-comments"></i> Comentários</a></li>
                <li><a href="<?= $prefix ?>carrinho.php">
                    <i class="fas fa-shopping-cart"></i> Carrinho
                    <?php
                    // Badge do carrinho
                    if (isset($_SESSION['user_id'])) {
                        global $conn;
                        if (isset($conn)) {
                            $uid = (int)$_SESSION['user_id'];
                            $r = $conn->query("SELECT SUM(quantidade) as total FROM carrinho WHERE user_id=$uid AND comprado=0");
                            $row = $r->fetch_assoc();
                            if ($row['total'] > 0) echo '<span class="cart-badge">'.(int)$row['total'].'</span>';
                        }
                    }
                    ?>
                </a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="<?= $prefix ?>logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
                <?php else: ?>
                    <li><a href="<?= $prefix ?>login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<div class="page-content">
