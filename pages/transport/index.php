<?php 
require_once BASE_PATH . '/bootstrap.php';

require_once LAYOUT_PATH . '/main.layout.php';
require_once COMPONENT_PATH . '/componentGroup/navbar.component.php';
require_once COMPONENT_PATH . '/componentGroup/footer.component.php';

?>
<link rel="stylesheet" href = "/page/transport/assets/css/transport.css">

<nav>
    <?php echo getNavbar('Transport'); ?>
</nav>

<body>
    <div class="swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide" onclick="showVehicleDetails('Caterpillar 797F', '/page/transport/assets/img/caterpillar.png', 'Ultra-class dump truck for mining (~400 tons payload)', 1200000)">
                <img src="/page/transport/assets/img/caterpillar.png" alt="Caterpillar 797F">
                <div class="caption">
                    <h5>Caterpillar 797F</h5>
                    <p>Ultra-class dump truck for mining (~400 tons payload)</p>
                </div>
            </div>

            <div class="swiper-slide" onclick="showVehicleDetails('Komatsu 930E-5', '/page/transport/assets/img/komatsu.png', 'Electric haul truck used in large open-pit mines', 1150000)">
                <img src="/page/transport/assets/img/komatsu.png" alt="Komatsu 930E-5">
                <div class="caption">
                    <h5>Komatsu 930E-5</h5>
                    <p>Electric haul truck used in large open-pit mines</p>
                </div>
            </div>

            <div class="swiper-slide" onclick="showVehicleDetails('GE AC6000CW', '/page/transport/assets/img/GE-train.png', 'Heavy-duty locomotive used to haul bulk mineral freight', 2500000)">
                <img src="/page/transport/assets/img/GE-train.png" alt="GE AC6000CW">
                <div class="caption">
                    <h5>GE AC6000CW</h5>
                    <p>Heavy-duty locomotive used to haul bulk mineral freight</p>
                </div>
            </div>


            <div class="swiper-slide" onclick="showVehicleDetails('Valemax Carrier', '/page/transport/assets/img/valemax.png', 'Massive ocean vessel designed for transporting iron ore', 30000000)">
                <img src="/page/transport/assets/img/valemax.png" alt="Valemax Carrier">
                <div class="caption">
                    <h5>Valemax Carrier</h5>
                    <p>Massive ocean vessel designed for transporting iron ore</p>
                </div>
            </div>

            <div class="swiper-slide" onclick="showVehicleDetails('Mercedes-Benz Actros', '/page/transport/assets/img/mercedes-benz.png', 'Long-distance truck used for hauling mineral liquids', 95000)">
                <img src="/page/transport/assets/img/mercedes-benz.png" alt="Mercedes-Benz Actros">
                <div class="caption">
                    <h5>Mercedes-Benz Actros</h5>
                    <p>Long-distance truck used for hauling mineral liquids</p>
                </div>
            </div>

            <div class="swiper-slide" onclick="showVehicleDetails('Sandvik TH663i', '/page/transport/assets/img/sandvik.png', 'High-capacity underground mining truck for tunnel hauling', 800000)">
                <img src="/page/transport/assets/img/sandvik.png" alt="Sandvik TH663i">
                <div class="caption">
                    <h5>Sandvik TH663i</h5>
                    <p>High-capacity underground mining truck for tunnel hauling</p>
                </div>
            </div>
        </div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-pagination"></div>
    </div>

    <div class="vehicle-detail hidden" id="vehicleDetail">
        <img id="vehicleImage" src="" alt="Vehicle">
        <div class="vehicle-info">
            <h2 id="vehicleName"></h2>
            <p id="vehicleDesc"></p>
            <p id="vehiclePrice"></p>
            <button onclick="goBackToCarousel()">Back to Carousel</button>
        </div>
    </div>

<!-- swiper -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script src="/page/transport/assets/js/transport.js"></script>
<?php echo getfooter(); ?>

