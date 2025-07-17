<?php

function renderProductCards(array $products): void {
    foreach ($products as $product): ?>
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
            <div class="quantity">
                <button type="button" class="minus" aria-label="Decrease">-</button>
                <input type="number" class="input-box" name="quantities[<?= $product['id'] ?>|product]" value="0" min="0" max="<?= $product['stock'] ?>">
                <button type="button" class="plus" aria-label="Increase">+</button>
            </div>
        </div>
    <?php endforeach;
}
