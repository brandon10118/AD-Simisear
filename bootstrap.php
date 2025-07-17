<?php
define('BASE_PATH', realpath(__DIR__));
define('HANDLERS_PATH', realpath(BASE_PATH . "/handlers"));
define('VENDOR_PATH', realpath(BASE_PATH . "/vendor"));
define('COMPONENT_PATH', realpath(BASE_PATH . "/components"));
define('UTILS_PATH', realpath(BASE_PATH . "/utils"));
define('STATICDATA_PATH', realpath(BASE_PATH . "/staticData"));
define('LAYOUT_PATH', realpath(BASE_PATH . "/layout"));
define('ASSETS_PATH', realpath(BASE_PATH . "/assets"));

chdir(BASE_PATH);

require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . '/auth.util.php';
Auth::init();

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

?>