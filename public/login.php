<?php
require_once '../config.php';
require_once '../auth/src/User.php';
require_once '../auth/src/Auth.php';

use MyAuthLib\User;

$user = new User($pdo);
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($user->login($email, $password)) {
        header('Location: index.php');
        exit;
    } else {
        $message = 'Login fehlgeschlagen!';
    }
}
?>

<form method="post">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Passwort" required>
    <button type="submit">Login</button>
</form>
<p><?= $message ?></p>