<?php

class Venda
{
    public static function registrar($id_produto, $quantidade, $valor_total)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('INSERT INTO vendas (id_produto, quantidade, valor_total) VALUES (?, ?, ?)');
        return $stmt->execute([$id_produto, $quantidade, $valor_total]);
    }

    public static function getHistorico()
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query('
            SELECT 
                v.id, 
                p.nome as nome_produto, 
                v.quantidade, 
                v.valor_total, 
                v.data_venda 
            FROM vendas v
            JOIN produtos p ON v.id_produto = p.id
            ORDER BY v.data_venda DESC
        ');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
