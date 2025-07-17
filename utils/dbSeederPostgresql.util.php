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

echo "✅ Connected to PostgreSQL for seeding\n";

// 🌱 Seeding users
$users = require_once STATICDATA_PATH . '/user.staticData.php';
echo "🌱 Seeding users…\n";
$stmt = $pdo->prepare("
  INSERT INTO users (email, password, name, role)
  VALUES (:email, :password, :name, :role)
");
foreach ($users as $u) {
  $stmt->execute([
    ':email' => $u['email'],
    ':password' => password_hash($u['password'], PASSWORD_DEFAULT),
    ':name' => $u['name'],
    ':role' => $u['role'],
  ]);
}

// 🌱 Seeding product
$products = require_once STATICDATA_PATH . '/product.staticData.php';
echo "🌱 Seeding products…\n";
$stmt = $pdo->prepare("
  INSERT INTO products (name, description, price, category, stock, image)
  VALUES (:name, :desc, :price, :cat, :stock, :image)
");
foreach ($products as $p) {
  $stmt->execute([
    ':name' => $p['name'],
    ':desc' => $p['description'],
    ':price' => $p['price'],
    ':cat' => $p['category'],
    ':stock' => $p['stock'],
    ':image' => $p['image']
  ]);
}

// 🌱 Seeding minerals
$minerals = require_once STATICDATA_PATH . '/mineral.staticData.php';
echo "🌱 Seeding minerals…\n";

$stmt = $pdo->prepare("
  INSERT INTO minerals (name, origin, type, description, image, price, stock)
  VALUES (:name, :origin, :type, :desc, :image, :price, :stock)
");

foreach ($minerals as $m) {
  $stmt->execute([
    ':name' => $m['name'],
    ':origin' => $m['origin'],
    ':type' => $m['type'],
    ':desc' => $m['description'],
    ':image' => $m['image'],
    ':price' => $m['price'],
    ':stock' => $m['stock']
  ]);
}

// 🌱 Seeding cart
$carts = require_once STATICDATA_PATH . '/cart.staticData.php';
echo "🌱 Seeding carts…\n";

// Fetch user IDs and map them again (only customers)
$userStmt = $pdo->query("SELECT id FROM users WHERE role = 'user'");
$customerIds = $userStmt->fetchAll(PDO::FETCH_COLUMN);
$userRefs = [
  'user_1' => $customerIds[0] ?? null,
  'user_2' => $customerIds[1] ?? null,
  'user_3' => $customerIds[2] ?? null,
];

// Fetch product IDs and prices
$productStmt = $pdo->query("SELECT id, price FROM products");
$productData = $productStmt->fetchAll(PDO::FETCH_ASSOC);
$productRefs = [];
foreach ($productData as $index => $row) {
  $key = 'prod_' . ($index + 1);
  $productRefs[$key] = [
    'id' => $row['id'],
    'price' => $row['price'],
  ];
}

$stmt = $pdo->prepare("
  INSERT INTO carts (user_id, product_id, quantity, price)
  VALUES (:user_id, :product_id, :quantity, :price)
");

foreach ($carts as $c) {
  $userId = $userRefs[$c['user_ref']] ?? null;
  $product = $productRefs[$c['product_ref']] ?? null;

  if (!$userId || !$product) {
    echo "⚠️ Skipping cart item: Missing user or product reference\n";
    continue;
  }

  $stmt->execute([
    ':user_id' => $userId,
    ':product_id' => $product['id'],
    ':quantity' => $c['quantity'],
    ':price' => $product['price'],
  ]);
}



echo "🎉 Seeding complete!\n";
