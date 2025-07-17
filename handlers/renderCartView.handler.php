<?php function renderCartView(array $cartItems, float $totalCartPrice, bool $purchaseCompleted): void { ?>
    <div class="main-box">
        <h1>Your Shopping Cart</h1>

        <?php if ($purchaseCompleted): ?>
            <div class="purchase-success">
                <h3>✅ Purchase Completed!</h3>
                <p>Thank you for your order.</p>
            </div>
        <?php endif; ?>

        <?php if (empty($cartItems)): ?>
            <p>Your cart is empty. Visit <a href="/page/tools/index.php">Tools</a> or <a href="/page/minerals/index.php">Minerals</a> to add items!</p>
        <?php else: ?>
            <form method="POST">
                <div class="cart-items-list">
                    <?php foreach ($cartItems as $item): ?>
                        <div class="cart-item">
                            <img src="<?= $item['image_path'] . htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="cart-item-image">
                            <div class="item-details">
                                <h3><?= htmlspecialchars($item['name']) ?></h3>
                                <p>Type: <?= htmlspecialchars($item['type']) ?></p>
                                <p>Unit Price: $<?= number_format($item['unit_price'], 2) ?></p>
                                <p>Subtotal: $<?= number_format($item['subtotal'], 2) ?></p>
                                <p>Quantity: <?= $item['quantity'] ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="cart-summary">
                    <h2>Total Cart Price: $<?= number_format($totalCartPrice, 2) ?></h2>
                    <button type="submit" name="checkout" value="true" class="checkout-btn">Proceed to Checkout</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
<?php } ?>
