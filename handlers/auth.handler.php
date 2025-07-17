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
} elseif ($action === 'signup') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $success = Auth::signup($name, $email, $password);
    if ($success) {
        header('Location: /index.php');
        exit;
    } else {
        header(header: 'Location: /page/login/index.php?error=Email%20already%20exists');
        exit;
    }
} else {
    header('Location: /page/login/index.php?error=Unknown%20action');
    exit;
}
