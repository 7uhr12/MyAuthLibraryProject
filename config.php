<?php
// Wähle DB-Typ: 'mysql' oder 'sqlite'
define('DB_TYPE', 'sqlite'); // oder 'mysql'

// MySQL-Konfiguration
define('DB_HOST', 'localhost');
define('DB_NAME', 'testdb');
define('DB_USER', 'dbuser');
define('DB_PASS', 'dbpass');

// SQLite-Pfad
define('SQLITE_PATH', __DIR__ . '/data/local.sqlite');

// PDO DSN bestimmen
if (DB_TYPE === 'mysql') {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} else {
    $dsn = "sqlite:" . SQLITE_PATH;
    $pdo = new PDO($dsn, null, null, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}

// User-Tabelle erstellen, falls nicht existiert (SQLite/MySQL kompatibel)
$pdo->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL
)");