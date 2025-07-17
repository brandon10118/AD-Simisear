<?php
require_once BASE_PATH . '/bootstrap.php';
require_once HANDLERS_PATH . '/stockUpdate.handler.php';
require_once LAYOUT_PATH . '/main.layout.php';
require_once COMPONENT_PATH . '/componentGroup/navbar.component.php';
require_once COMPONENT_PATH . '/componentGroup/footer.component.php';

// Ensure $products and $minerals are defined
$products = isset($products) ? $products : [];
$minerals = isset($minerals) ? $minerals : [];

extract(handleStockUpdate());
?>
<link rel="stylesheet" href="/page/addstock/asset/css/style.css">
<nav>
    <?= getNavbar('Add Stock'); ?>
</nav>
<main class="container">
    <h2>Update Stocks</h2>
    <form method="POST" class="stock-form">
        <h3>Product Stock</h3>
        <select name="product_id">
            <option disabled selected>Select a Product</option>
            <?php foreach ($products as $product): ?>
                <option value="<?= $product['id'] ?>">
                    <?= htmlspecialchars($product['name']) ?> (Current: <?= $product['stock'] ?>)
                </option>
            <?php endforeach; ?>
        </select>

    <h3>Mineral Stock</h3>
    <select name="mineral_id">
        <option disabled selected>Select a Mineral</option>
        <?php foreach ($minerals as $mineral): ?>
            <option value="<?= $mineral['id'] ?>">
                <?= htmlspecialchars($mineral['name']) ?> (Current: <?= $mineral['stock'] ?>)
            </option>
        <?php endforeach; ?>
    </select>

    <label for="stock">New Stock to Add:</label>
    <input type="number" name="stock" min="0" required>

    <button type="submit">Update Stock</button>
</form>
</main> 
<?= getFooter(); ?>