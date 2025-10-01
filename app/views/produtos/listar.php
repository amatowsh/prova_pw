<?php include_once __DIR__ . '/../components/navbar.php'; ?>

<div class="container-custom">
    <section class="produtos-section">
        <h1 class="text-center mb-4">Produtos Disponíveis</h1>

        <?php if (isset($_SESSION['mensagem'])): ?>
            <div class="alert-custom alert-<?php echo $_SESSION['tipo_mensagem']; ?>" role="alert">
                <?php echo $_SESSION['mensagem']; ?>
                <button type="button" class="close" onclick="this.parentElement.style.display='none'" aria-label="Close" style="float: right; background: none; border: none; font-size: 1.5rem; cursor: pointer;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            unset($_SESSION['mensagem']);
            unset($_SESSION['tipo_mensagem']);
            ?>
        <?php endif; ?>

        <?php if (!empty($produtos)): ?>
            <div class="produtos-grid">
                <?php foreach ($produtos as $produto): ?>
                    <div class="produto-card">
                        <div class="produto-img">
                            <img src="https://via.placeholder.com/400x300?text=<?php echo urlencode($produto['nome']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="produto-info">
                            <h3 class="produto-nome"><?php echo htmlspecialchars($produto['nome']); ?></h3>
                            <div class="produto-preco">R$ <?php echo number_format($produto['valor'], 2, ',', '.'); ?></div>
                            <div class="produto-estoque">
                                <?php if ($produto['estoque'] > 0): ?>
                                    <span style="color: #28a745;"><?php echo $produto['estoque']; ?> em estoque</span>
                                <?php else: ?>
                                    <span style="color: #dc3545;">Produto esgotado</span>
                                <?php endif; ?>
                            </div>

                            <?php if ($produto['estoque'] > 0): ?>
                                <form action="index.php?controller=venda&action=registrar" method="post" class="produto-actions">
                                    <input type="hidden" name="id_produto" value="<?php echo $produto['id']; ?>">
                                    <input type="number" name="quantidade" class="quantidade-input" value="1" min="1" max="<?php echo $produto['estoque']; ?>" title="Quantidade">
                                    <button type="submit" class="btn-comprar">Comprar</button>
                                </form>
                            <?php else: ?>
                                <div class="produto-actions">
                                    <button class="btn-comprar" disabled>Esgotado</button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center p-4">
                <h2>Nenhum produto encontrado</h2>
                <p>No momento não temos produtos disponíveis.</p>
            </div>
        <?php endif; ?>
    </section>
</div>

<?php include_once __DIR__ . '/../components/footer.php'; ?>