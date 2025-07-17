<?php
use Dotenv\Dotenv;

if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__));
}

require_once BASE_PATH . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(BASE_PATH);
$dotenv->safeLoad();

return [
    'mongo' => [
        'uri' => $_ENV['MONGO_URI'] ?? '',
        'db'  => $_ENV['MONGO_DB'] ?? '',
    ],
    'postgres' => [
        'host'     => $_ENV['POSTGRES_HOST'] ?? 'localhost',
        'port'     => $_ENV['POSTGRES_PORT'] ?? '5432',
        'db'       => $_ENV['POSTGRES_DB'] ?? 'finalproject',
        'user'     => $_ENV['POSTGRES_USER'] ?? 'user',
        'password' => $_ENV['POSTGRES_PASSWORD'] ?? 'password',
    ],
];
