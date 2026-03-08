<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php';

use MyAuthLib\User;

$user = new User($pdo);
$user->logout();

header('Location: login.php');
exit;