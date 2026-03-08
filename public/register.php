<?php
require_once '../config.php';
require_once '../auth/src/User.php';

use MyAuthLib\User;

$user = new User($pdo);
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($user->register($email, $password)) {
        $message = 'Registrierung erfolgreich! Du kannst dich jetzt einloggen.';
    } else {
        $message = 'Fehler: Benutzer existiert möglicherweise schon.';
    }
}
?>

<form method="post">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Passwort" required>
    <button type="submit">Registrieren</button>
</form>
<p><?= $message ?></p>