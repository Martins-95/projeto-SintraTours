<?php
session_start();
require_once('includes/ligacao.php');
$page_title = 'Sintra Tours - Explora Sintra com os Nossos Packs Exclusivos';

// Buscar packs em destaque
$res_dest = $conn->query("SELECT p.*, c.nome as categoria FROM produtos p LEFT JOIN categorias c ON p.categoria_id=c.id WHERE p.destaque=1 ORDER BY p.preco ASC");

// Mensagem de feedback após adicionar ao carrinho
$msg = '';
if (isset($_GET['added']) && $_GET['added'] == 1) {
    $msg = '<div class="alert alert-success"><i class="fas fa-check-circle"></i> Pack adicionado ao carrinho!</div>';
}
if (isset($_GET['login_required'])) {
    $msg = '<div class="alert alert-warning"><i class="fas fa-exclamation-circle"></i> Precisa de <a href="login.php">fazer login</a> para adicionar ao carrinho.</div>';
}
?>
<?php include 'includes/menu.php'; ?>

<!-- HERO / ABOUT -->
<section id="about" class="section">
    <h1 id="titulo1">Explore a magia de Sintra</h1>
    <p>Junte-se a nós numa visita inesquecível por Sintra — um local Património Mundial da UNESCO conhecido pelos seus palácios de contos de fadas, florestas exuberantes e atmosfera romântica.</p>
    <div id="video">
        <iframe width="560" height="315"
            src="https://www.youtube.com/embed/5nP7jlN7n0c?si=D4MfYQyylSCpXdPT"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
        </iframe>
    </div>
</section>

<!-- GALERIA -->
<section id="gallery" class="section">
    <h2>Descubra Marcos Icónicos</h2>
    <div class="gallery-container">
        <img src="Imagens/Palacio_Nacional_Sintra.jpg" alt="Palácio Nacional de Sintra">
        <img src="Imagens/Castelo_dos_Mouros.jpg" alt="Castelo dos Mouros">
        <img src="Imagens/Quinta_da_Regaleira.jpg" alt="Quinta da Regaleira">
    </div>
</section>

<!-- PACKS DE VIAGEM -->
<section id="packs" class="section">
    <h2>Os Nossos Packs de Viagem</h2>
    <p class="section-sub">Escolha o pack perfeito para a sua visita a Sintra. Todos os preços são por pessoa.</p>

    <?= $msg ?>

    <div class="packs-grid">
        <?php if ($res_dest && $res_dest->num_rows > 0): ?>
            <?php while ($pack = $res_dest->fetch_assoc()): ?>
            <div class="pack-card <?= $pack['preco'] >= 70 ? 'pack-featured' : '' ?>">
                <?php if ($pack['stock'] <= 5): ?>
                    <div class="pack-badge">Popular</div>
                <?php endif; ?>
                <div class="pack-icon">
                    <?php
                    // Ícone conforme o nome do pack
                    $icons = [
                        'Clássico' => 'fa-landmark',
                        'Romântico' => 'fa-heart',
                        'Completo' => 'fa-star',
                        'Família' => 'fa-users',
                        'Meio-Dia' => 'fa-clock',
                        'Privado' => 'fa-crown',
                    ];
                    $icon = 'fa-map-marked-alt';
                    foreach ($icons as $key => $val) {
                        if (stripos($pack['nome'], $key) !== false) { $icon = $val; break; }
                    }
                    ?>
                    <i class="fas <?= $icon ?>"></i>
                </div>
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
        <?php else: ?>
            <p>Nenhum pack disponível de momento.</p>
        <?php endif; ?>
    </div>
     <div class="packs-ver-todos">
        <a href="packs.php" class="btn-todos">Ver Todos os Packs <i class="fas fa-arrow-right"></i></a>
    </div>
</section>

<!-- TESTEMUNHOS -->
<section id="testemunhos" class="section">
    <h2>O Que Dizem os Nossos Visitantes</h2>
    <div class="testemunhos-container">
        <div class="testemunho">
            <p>"Uma experiência mágica! Sintra superou todas as minhas expectativas."</p>
            <strong>— Maria Silva</strong>
        </div>
        <div class="testemunho">
            <p>"Os palácios são de tirar o fôlego. Recomendo vivamente!"</p>
            <strong>— João Santos</strong>
        </div>
        <div class="testemunho">
            <p>"Guia excelente e paisagens absolutamente espetaculares."</p>
            <strong>— Ana Costa</strong>
        </div>
    </div>
</section>

<!-- CONTACTO / RESERVA -->
<section id="booking" class="section">
    <h2>Pronto para Explorar?</h2>
    <p>Escolha um pack acima ou entre em contacto connosco para um orçamento personalizado.</p>
    <div class="booking-btns">
        <a href="#packs" class="btn-primary"><i class="fas fa-map-marked-alt"></i> Ver Packs</a>
        <a href="contacto.php" class="btn-secondary"><i class="fas fa-envelope"></i> Contactar</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>


<script>
// Scroll suave para âncoras
document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
        const target = document.querySelector(a.getAttribute('href'));
        if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); }
    });
});
</script>
