<?php
session_start();
require_once('includes/ligacao.php');
$page_title = 'Packs de Viagem';

// Detalhe de um pack específico
$pack_detalhe = null;
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $r = $conn->query("SELECT p.*, c.nome as categoria FROM produtos p LEFT JOIN categorias c ON p.categoria_id=c.id WHERE p.id=$id");
    if ($r && $r->num_rows == 1) $pack_detalhe = $r->fetch_assoc();
}

// Listar todos os packs por categoria
$categorias = $conn->query("SELECT * FROM categorias ORDER BY id");

$msg = '';
if (isset($_GET['added'])) $msg = '<div class="alert alert-success"><i class="fas fa-check-circle"></i> Pack adicionado ao carrinho!</div>';
if (isset($_GET['login_required'])) $msg = '<div class="alert alert-warning"><i class="fas fa-exclamation-circle"></i> Precisa de <a href="login.php">fazer login</a> para adicionar ao carrinho.</div>';
?>
<?php include 'includes/menu.php'; ?>

<div class="inner-page-hero">
    <h1>Packs de Viagem</h1>
    <p>Descubra todas as nossas experiências em Sintra</p>
</div>

<?= $msg ?>

<?php if ($pack_detalhe): ?>
<!-- DETALHE DE UM PACK -->
<section class="section pack-detalhe-section">
    <div class="pack-detalhe-card">
        <a href="packs.php" class="btn-back"><i class="fas fa-arrow-left"></i> Todos os Packs</a>
        <h2><?= htmlspecialchars($pack_detalhe['nome']) ?></h2>
        <p class="pack-categoria-label"><?= htmlspecialchars($pack_detalhe['categoria']) ?></p>
        <p class="pack-desc-full"><?= nl2br(htmlspecialchars($pack_detalhe['descricao'])) ?></p>
        <div class="pack-detalhe-info">
            <div class="info-item"><i class="far fa-clock"></i><span>Duração: <?= htmlspecialchars($pack_detalhe['duracao']) ?></span></div>
            <div class="info-item"><i class="fas fa-user-check"></i><span>Lugares disponíveis: <?= (int)$pack_detalhe['stock'] ?></span></div>
            <div class="info-item"><i class="fas fa-map-marker-alt"></i><span>Sintra, Portugal</span></div>
            <div class="info-item"><i class="fas fa-language"></i><span>Guia em Português e Inglês</span></div>
        </div>
        <div class="pack-detalhe-preco">
            <span class="preco-big"><?= number_format($pack_detalhe['preco'], 2, ',', '.') ?> €</span>
            <span class="preco-label">por pessoa</span>
        </div>

        <div class="pack-detalhe-reserva">
            <form action="adicionar_carrinho.php" method="post">
                <input type="hidden" name="produto_id" value="<?= $pack_detalhe['id'] ?>">
                <div class="form-group-inline">
                    <label for="quantidade">Pessoas:</label>
                    <input type="number" id="quantidade" name="quantidade" value="1" min="1" max="<?= (int)$pack_detalhe['stock'] ?>">
                </div>
                <div class="form-group-inline">
                    <label for="data_visita">Data da Visita:</label>
                    <input type="date" id="data_visita" name="data_visita" min="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>
                </div>
                <button type="submit" class="btn-carrinho-grande">
                    <i class="fas fa-shopping-cart"></i> Adicionar ao Carrinho
                </button>
            </form>
        </div>
    </div>
</section>

<?php else: ?>
<!-- LISTAGEM DE TODOS OS PACKS -->
<?php while ($cat = $categorias->fetch_assoc()): ?>
    <?php
    $res_packs = $conn->query("SELECT * FROM produtos WHERE categoria_id={$cat['id']} ORDER BY preco ASC");
    if (!$res_packs || $res_packs->num_rows == 0) continue;
    ?>
    <section class="section packs-section">
        <h2 class="categoria-titulo"><i class="fas fa-tag"></i> <?= htmlspecialchars($cat['nome']) ?></h2>
        <?php if ($cat['descricao']): ?>
            <p class="categoria-desc"><?= htmlspecialchars($cat['descricao']) ?></p>
        <?php endif; ?>
        <div class="packs-grid">
            <?php while ($pack = $res_packs->fetch_assoc()): ?>
            <div class="pack-card pack-item">
                <h3 class="pack-title"><?= htmlspecialchars($pack['nome']) ?></h3>
                <p class="pack-duracao"><i class="far fa-clock"></i> <?= htmlspecialchars($pack['duracao']) ?></p>
                <p class="pack-desc"><?= htmlspecialchars($pack['descricao']) ?></p>
                <div class="pack-preco">
                    <span class="preco-valor"><?= number_format($pack['preco'], 2, ',', '.') ?> €</span>
                    <span class="preco-label">/ pessoa</span>
                </div>
                <div class="pack-actions">
                    <a href="packs.php?id=<?= $pack['id'] ?>" class="btn-detalhes">Ver Detalhes</a>
                    <a href="adicionar_carrinho.php?id=<?= $pack['id'] ?>" class="btn-carrinho">
                        <i class="fas fa-shopping-cart"></i> Adicionar
                    </a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </section>
<?php endwhile; ?>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
