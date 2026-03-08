<?php
namespace MyAuthLib;

use PDO;

class User {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function register(string $email, string $password): bool {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        return $stmt->execute([$email, $hash]);
    }

    public function login(string $email, string $password): bool {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            Auth::startSession();
            $_SESSION['user_id'] = $user['id'];
            return true;
        }
        return false;
    }

    public function logout(): void {
        Auth::destroySession();
    }

    public function isLoggedIn(): bool {
        Auth::startSession();
        return isset($_SESSION['user_id']);
    }
}