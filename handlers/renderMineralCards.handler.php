<?php

function renderMineralCards(array $minerals, bool $enableQuantityControls = true): void
{
    foreach ($minerals as $mineral): ?>
        <div class="mineral-card" data-type="<?= strtolower($mineral['type']) ?>">
            <img src="assets/img/<?= htmlspecialchars($mineral['image']) ?>" alt="<?= htmlspecialchars($mineral['name']) ?>">
            <h2><?= htmlspecialchars($mineral['name']) ?></h2>
            <p><strong>Origin:</strong> <?= htmlspecialchars($mineral['origin']) ?></p>
            <p><strong>Type:</strong> <?= htmlspecialchars($mineral['type']) ?></p>
            <p><?= htmlspecialchars($mineral['description']) ?></p>
            <p><strong>Price:</strong> $<?= number_format($mineral['price'], 2) ?></p>
            <p><strong>Stock:</strong> <?= $mineral['stock'] ?></p>
            
            <?php if ($enableQuantityControls): ?>
                <div class="quantity">
                    <button type="button" class="minus" aria-label="Decrease">-</button>
                    <input type="number" class="input-box" name="quantities[<?= $mineral['id'] ?>|mineral]" value="0" min="0" max="<?= $mineral['stock'] ?>">
                    <button type="button" class="plus" aria-label="Increase">+</button>
                </div>
            <?php else: ?>
                <div class="quantity-disabled">
                    <span class="disabled-text">Login to purchase</span>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach;
}
