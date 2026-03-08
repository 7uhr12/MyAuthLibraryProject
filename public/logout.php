<?php
require_once '../auth/src/User.php';

use MyAuthLib\User;

$user = new User($pdo);
$user->logout();

header('Location: login.php');
exit;