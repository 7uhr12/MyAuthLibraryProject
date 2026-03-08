<?php
require_once '../auth/src/User.php';

use MyAuthLib\User;

$user = new User($pdo);
if (!$user->isLoggedIn()) {
    header('Location: login.php');
    exit;
}

echo "Willkommen, du bist eingeloggt!";
echo '<br><a href="logout.php">Logout</a>';