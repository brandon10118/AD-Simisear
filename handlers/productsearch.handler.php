<?php

require_once UTILS_PATH . '/dbConnection.util.php';
require_once UTILS_PATH . '/dbRepository.util.php';

function getSearchedProducts(): array {
    $db = getDatabaseConnection();
    $productRepo = new ProductRepository($db);

    // Get search parameters from URL
    $searchTerm = $_GET['search'] ?? '';
    $categoryFilter = $_GET['category'] ?? '';

    // Return the filtered products
    return $productRepo->searchProducts($searchTerm, $categoryFilter);
}
