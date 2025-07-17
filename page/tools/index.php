<?php 
require_once BASE_PATH . '/bootstrap.php';

require_once LAYOUT_PATH . '/main.layout.php';
require_once COMPONENT_PATH . '/componentGroup/navbar.component.php';
require_once COMPONENT_PATH . '/componentGroup/footer.component.php';

require_once HANDLERS_PATH . '/productsearch.handler.php';
require_once HANDLERS_PATH . '/renderProductCards.handler.php';

$products = getSearchedProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Greek Tools</title>
    <link rel="stylesheet" href="/page/tools/assets/css/tools.css">
    <script src="/page/tools/assets/js/script.js" defer></script>
</head>

<body>
    <nav>
        <?php echo getNavbar('Tools'); ?>
    </nav>

    <div class="container">
        <main>
            <div class="image" style="position: relative; display: inline-block;">
                <img src="assets/img/Anvil.png" alt="Greek Tools" style="width:100%;">
                <span class="innertext">
                    Greek Tools
                    <br>
                    Discover the finest selection of traditional Greek tools, crafted for durability and performance.
                </span>
            </div>

            <div class="main-box">
                <div class="search-container">
                    <input id="searchInput" class="search" type="text" placeholder="Search…">
                    <button onclick="searchProducts()" class="search-btn">Search</button>
                </div>

                <nav>
                    <button type="button" onclick="filterType('all')">All</button>
                    <button type="button" onclick="filterType('pickaxes')">Pickaxes</button>
                    <button type="button" onclick="filterType('shovels')">Shovels</button>
                    <button type="button" onclick="filterType('drills')">Drills</button>
                    <button type="button" onclick="filterType('helmets')">Helmet</button>
                    <button type="button" onclick="filterType('tnt')">TNT</button>
                </nav>

                <form method="POST" action="/page/addtocart/index.php">
                    <div class="product-list">
                        <?php renderProductCards($products); ?>
                    </div>
                    <button type="submit" class="add-cart">Add to Cart</button>
                </form>
            </div>
        </main>
    </div>

    <?php echo getFooter(); ?>
</body>

</html>
