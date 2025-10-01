<?php

class Produto
{
    public static function getAll()
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query('SELECT * FROM produtos ORDER BY nome');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById($id)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM produtos WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function atualizarEstoque($id, $quantidade)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('UPDATE produtos SET estoque = estoque - ? WHERE id = ?');
        return $stmt->execute([$quantidade, $id]);
    }

    public function calcularValorTotal($quantidade, $valor)
    {
        return $valor * $quantidade;
    }

    public function listar()
    {
        return self::getAll();
    }
}
