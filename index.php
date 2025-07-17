<?php
require_once BASE_PATH . '/bootstrap.php';

require_once LAYOUT_PATH . '/main.layout.php';
require_once COMPONENT_PATH . '/componentGroup/navbar.component.php';
require_once COMPONENT_PATH . '/componentGroup/footer.component.php';

?>

<nav>
    <?php echo getNavbar('Home'); ?>
</nav>

<div class="main-content">
    <div class="heading-wrapper">
        <img src="assets/img/eye.png" alt="sculpture" class="eye" />
        <img src="assets/img/mouth.png" alt="sculpture" class="mouth" />
        <h1 class="heading">GEMSTONE</h1>
    </div>
    <p class="minitext">
        Discover the captivating beauty and unique properties of various gemstones, from their geological formation
        to their cultural significance and uses in jewelry and art.
    </p>
</div>


<script src="/page/home/assets/js/script.js"></script>

<?php echo getFooter(); ?>
</body>

</html>