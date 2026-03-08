<?php
namespace MyAuthLib;

use PDO;
use PDOException;

class Database {
    private PDO $pdo;

    /**
     * $dsn = 'mysql:host=localhost;dbname=testdb;charset=utf8mb4'
     * $dsn = 'sqlite:' . __DIR__ . '/data.sqlite'
     */
    public function __construct(string $dsn, string $user = '', string $pass = '') {
        try {
            $this->pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            die("DB Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection(): PDO {
        return $this->pdo;
    }
}