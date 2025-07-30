<?php

function renderProductCards(array $products, bool $enableQuantityControls = true): void {
    // Group products by category
    $groupedProducts = [];
    foreach ($products as $product) {
        $category = $product['category'];
        if (!isset($groupedProducts[$category])) {
            $groupedProducts[$category] = [];
        }
        $groupedProducts[$category][] = $product;
    }

    // Define category display names
    $categoryNames = [
        'pickaxes' => 'Pickaxes',
        'shovels' => 'Shovels', 
        'drills' => 'Drills',
        'helmets' => 'Helmets',
        'tnt' => 'TNT'
    ];

    // Render each category section
    foreach ($groupedProducts as $category => $categoryProducts): ?>
        <div class="category-section" data-category="<?= htmlspecialchars($category) ?>">
            <h2 class="category-title"><?= htmlspecialchars($categoryNames[$category] ?? ucfirst($category)) ?></h2>
            <div class="category-products">
                <?php foreach ($categoryProducts as $product): ?>
                    <div class="product" data-type="<?= htmlspecialchars($product['category']) ?>">
                        <?php if (!empty($product['image'])): ?>
                            <img src="../../page/tools/assets/img/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" style="width:100%">
                        <?php else: ?>
                            <div style="width:100%; height:150px; background:#eee; display:flex; align-items:center; justify-content:center;">No Image</div>
                        <?php endif; ?>

                        <h3><?= htmlspecialchars($product['name']) ?></h3>
                        <p>Type: <?= htmlspecialchars($product['category']) ?></p>
                        <p>Price: $<?= htmlspecialchars($product['price']) ?></p>
                        <p>Stock: <?= htmlspecialchars($product['stock']) ?></p>
                        
                        <?php if ($enableQuantityControls): ?>
                            <div class="quantity">
                                <button type="button" class="minus" aria-label="Decrease">-</button>
                                <input type="number" class="input-box" name="quantities[<?= $product['id'] ?>|product]" value="0" min="0" max="<?= $product['stock'] ?>">
                                <button type="button" class="plus" aria-label="Increase">+</button>
                            </div>
                        <?php else: ?>
                            <div class="quantity-disabled">
                                <span class="disabled-text">Login to purchase</span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach;
}
