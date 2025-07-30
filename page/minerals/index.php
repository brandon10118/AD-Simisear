<?php
require_once BASE_PATH . '/bootstrap.php';
require_once LAYOUT_PATH . '/main.layout.php';
require_once COMPONENT_PATH . '/componentGroup/navbar.component.php';
require_once COMPONENT_PATH . '/componentGroup/footer.component.php';
require_once UTILS_PATH . '/auth.util.php';
require_once HANDLERS_PATH . '/mineralsearch.handler.php';
require_once HANDLERS_PATH . '/renderMineralCards.handler.php';

// Initialize session and check if user is logged in
Auth::init();
$user = Auth::user();
$isLoggedIn = $user !== null;

$minerals = getSearchedMinerals();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Greek Minerals</title>
    <link rel="stylesheet" href="../../page/minerals/assets/css/mineral.css">
    <script src="../../page/minerals/assets/js/script.js" defer></script>
</head>
<body>

<div class="marquee-container">
    <div class="marquee-content"></div>
</div>

<?php echo getNavbar('Minerals'); ?>

<div class="main-content">
    <div class="header-section">
        <h1>Greek Mineral</h1>
        <p>Discover the finest selection of the minerals in our shop. Prized for their beauty and utility.</p>
    </div>

    <div class="filter-container">
        <div class="search-container">
            <input id="searchInput" class="search" type="text" placeholder="Search…">
            <button type="button" onclick="searchProducts()" class="search-btn">Search</button>
        </div>
        <div class="filter-buttons">
            <button class="filter-btn active" data-type="all">All</button>
            <button class="filter-btn" data-type="gemstone">Gemstone</button>
            <button class="filter-btn" data-type="ore">Ore</button>
            <button class="filter-btn" data-type="rock">Rock</button>
            <button class="filter-btn" data-type="mineral">Mineral</button>
        </div>
    </div>

    <div class="minerals-container">
        <?php if ($isLoggedIn): ?>
            <form method="POST" action="/page/addtocart/index.php">
                <div class="mineral-list" id="mineralsContainer">
                    <?php renderMineralCards($minerals); ?>
                </div>
                <button type="submit" class="add-cart">Add to Cart</button>
            </form>
        <?php else: ?>
            <div class="mineral-list" id="mineralsContainer">
                <?php renderMineralCards($minerals, false); ?>
            </div>
            <div class="login-prompt">
                <div class="login-message">
                    <h3>🔒 Login Required</h3>
                    <p>You need to be logged in to add minerals to your cart and make purchases.</p>
                    <a href="/page/login/index.php" class="login-btn">Login / Sign Up</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php echo getFooter(); ?>

</body>
</html>
