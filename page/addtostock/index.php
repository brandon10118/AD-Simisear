<?php
require_once BASE_PATH . '/bootstrap.php';
require_once LAYOUT_PATH . '/main.layout.php';
require_once COMPONENT_PATH . '/componentGroup/navbar.component.php';
require_once COMPONENT_PATH . '/componentGroup/footer.component.php';
require_once HANDLERS_PATH . '/cart.handler.php';
require_once HANDLERS_PATH . '/renderCartView.handler.php';

extract(handleCartLogic());
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Your Cart</title>
	<link rel="stylesheet" href="/page/addtocart/asset/css/style.css">
</head>
<body>
	<nav>
		<?= getNavbar('Add to Cart'); ?>
	</nav>
	<?php renderCartView($cartItems, $totalCartPrice, $purchaseCompleted); ?>
	<?= getFooter(); ?>
</body>
</html>