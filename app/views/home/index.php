<?php include_once __DIR__ . '/../components/navbar.php'; ?>

<div class="container-custom">
    <section class="produtos-destaque mb-4">
        <h2 class="text-center mb-3">Produtos em Destaque</h2>
        <?php if (!empty($produtos)): ?>
            <div class="produtos-grid">
                <?php foreach (array_slice($produtos, 0, 3) as $produto): ?>
                    <div class="produto-card fade-in-up">
                        <div class="produto-img">
                            <img src="https://via.placeholder.com/400x300?text=Produto" alt="<?= htmlspecialchars($produto['nome'], ENT_QUOTES, 'UTF-8') ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="produto-info">
                            <h3 class="produto-nome"><?= htmlspecialchars($produto['nome'], ENT_QUOTES, 'UTF-8') ?></h3>
                            <div class="produto-preco">R$ <?= number_format((float)$produto['preco'], 2, ',', '.') ?></div>
                            <a href="index.php?controller=produto&action=listar" class="btn-primary-custom">Ver Detalhes</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center p-4">
                <p>Em breve teremos produtos para você!</p>
            </div>
        <?php endif; ?>
    </section>
</div>

<?php include_once __DIR__ . '/../components/footer.php'; ?>