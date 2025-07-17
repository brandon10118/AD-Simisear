<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';
require_once 'bootstrap.php';

$typeConfig = require_once UTILS_PATH . '/envSetter.util.php';
$pgConfig = $typeConfig['postgres'];

$pdo = new PDO(
    "pgsql:host={$pgConfig['host']};port={$pgConfig['port']};dbname={$pgConfig['db']}",
    $pgConfig['user'],
    $pgConfig['password'],
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

echo "✅ Connected to PostgreSQL for migration\n";


echo "🗑️ Dropping old tables…\n";
foreach ([
    'carts',
    'products',
    'users',
    'minerals',
] as $table) {
    $pdo->exec("DROP TABLE IF EXISTS {$table} CASCADE;");
}


$models = [
    'database/user.model.sql',
    'database/product.model.sql',
    'database/cart.model.sql',
    'database/mineral.model.sql'
];

foreach ($models as $model) {
    echo "📄 Applying schema from {$model}…\n";

    $sql = file_get_contents($model);

    if ($sql === false) {
        throw new RuntimeException("❌ Could not read {$model}");
    }

    $pdo->exec($sql);
    echo "✅ Success: {$model}\n";
}

echo "🎉 Migration complete!\n";
