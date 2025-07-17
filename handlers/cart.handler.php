<?php
require_once UTILS_PATH . '/dbConnection.util.php';
require_once UTILS_PATH . '/dbRepository.util.php';

function handleCartLogic(): array {
    $db = getDatabaseConnection();
    $productRepo = new ProductRepository($db);
    $mineralRepo = new MineralRepository($db);

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $purchaseCompleted = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['quantities'])) {
            foreach ($_POST['quantities'] as $compositeKey => $quantity) {
                $parts = explode('|', $compositeKey);
                if (count($parts) !== 2) continue;

                list($productId, $type) = $parts;
                $quantity = (int)$quantity;

                if ($quantity > 0) {
                    $_SESSION['cart'][$compositeKey] = [
                        'quantity' => $quantity
                    ];
                } else {
                    unset($_SESSION['cart'][$compositeKey]);
                }
            }
        }

        if (isset($_POST['checkout'])) {
            foreach ($_SESSION['cart'] as $compositeKey => $info) {
                $parts = explode('|', $compositeKey);
                if (count($parts) !== 2) continue;

                list($productId, $type) = $parts;
                $quantity = (int)$info['quantity'];

                if ($type === 'product') {
                    $productRepo->updateStock($productId, -$quantity);
                } elseif ($type === 'mineral') {
                    $mineralRepo->updateStock($productId, -$quantity);
                }
            }

            $_SESSION['cart'] = [];
            $purchaseCompleted = true;
        }
    }

    $cartItems = [];
    $totalCartPrice = 0;

    foreach ($_SESSION['cart'] as $compositeKey => $info) {
        $quantity = $info['quantity'];

        $parts = explode('|', $compositeKey);
        if (count($parts) !== 2) continue;

        list($productId, $type) = $parts;

        if ($type === 'product') {
            $item = $productRepo->getById($productId);
            $imagePath = '/page/tools/assets/img/';
        } elseif ($type === 'mineral') {
            $item = $mineralRepo->getById($productId);
            $imagePath = '/page/minerals/assets/img/';
        } else {
            continue;
        }

        if ($item) {
            $subtotal = $item['price'] * $quantity;
            $totalCartPrice += $subtotal;

            $cartItems[] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'type' => ucfirst($type),
                'image' => $item['image'],
                'image_path' => $imagePath,
                'unit_price' => $item['price'],
                'quantity' => $quantity,
                'subtotal' => $subtotal
            ];
        }
    }

    return [
        'cartItems' => $cartItems,
        'totalCartPrice' => $totalCartPrice,
        'purchaseCompleted' => $purchaseCompleted
    ];
}
