<?php
declare(strict_types=1);
require_once __DIR__ . '/../bootstrap.php';
require_once UTILS_PATH . '/auth.util.php';

$action = $_GET['action'] ?? '';

if ($action === 'login') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $success = Auth::login($email, $password);
    if ($success) {
        header('Location: /index.php');
        exit;
    } else {
        header('Location: /page/login/index.php?error=Invalid%20credentials');
        exit;
    }
} else {
    header('Location: /page/login/index.php?error=Unknown%20action');
    exit;
}
