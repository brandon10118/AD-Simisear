<?php
ob_start();
require_once UTILS_PATH . '/dbConnection.util.php';
require_once UTILS_PATH . '/dbRepository.util.php';

function handleStockUpdate(): array
{
    $db = getDatabaseConnection();
    $productRepo = new ProductRepository($db);
    $mineralRepo = new MineralRepository($db);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newStock = (int) ($_POST['stock'] ?? 0);

        if (!empty($_POST['product_id'])) {
            $productId = $_POST['product_id'];
            $productRepo->updateStock($productId, $newStock);
        }

        if (!empty($_POST['mineral_id'])) {
            $mineralId = $_POST['mineral_id'];
            $mineralRepo->updateStock($mineralId, $newStock);
        }

        header('Location: /page/addstock/index.php');
        exit;
    }

    return [
        'products' => $productRepo->getAllProducts(),
        'minerals' => $mineralRepo->getAllMinerals()
    ];
}
?>