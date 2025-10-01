<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'loja_virtual');
define('DB_USER', 'root');
define('DB_PASS', 'fatec');

class Database {
    private static $pdo;

    public static function getConnection() {
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro de conexão: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
