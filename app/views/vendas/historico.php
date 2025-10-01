<?php include_once __DIR__ . '/../components/navbar.php'; ?>

<div class="container-custom">
    <section class="vendas-section">
        <h1 class="text-center mb-4">Histórico de Vendas</h1>

        <?php if (!empty($vendas)): ?>
            <div class="table-custom">
                <table>
                    <thead>
                        <tr>
                            <th>ID Venda</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Valor Total</th>
                            <th>Data da Venda</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vendas as $venda): ?>
                            <tr>
                                <td>#<?php echo str_pad($venda['id'], 4, '0', STR_PAD_LEFT); ?></td>
                                <td><?php echo htmlspecialchars($venda['nome_produto']); ?></td>
                                <td><?php echo $venda['quantidade']; ?></td>
                                <td>R$ <?php echo number_format($venda['valor_total'], 2, ',', '.'); ?></td>
                                <td><?php echo date('d/m/Y H:i', strtotime($venda['data_venda'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center p-4">
                <h2>Nenhuma venda registrada</h2>
                <p>Ainda não há vendas em nosso sistema.</p>
                <a href="index.php?controller=produto&action=listar" class="btn-primary-custom">Ver Produtos</a>
            </div>
        <?php endif; ?>
    </section>
</div>

<?php include_once __DIR__ . '/../components/footer.php'; ?>