<?php
ob_start();
require_once UTILS_PATH . '/dbConnection.util.php';
require_once UTILS_PATH . '/dbRepository.util.php';

function handleStockUpdate(): array
{
    $db = getDatabaseConnection();
    $productRepo = new ProductRepository($db);
    $mineralRepo = new MineralRepository($db);

    $message = '';
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';

        switch ($action) {
            case 'update_stock':
                $newStock = (int) ($_POST['stock'] ?? 0);

                if (!empty($_POST['product_id'])) {
                    $productId = $_POST['product_id'];
                    $productRepo->updateStock($productId, $newStock);
                    $message = 'Product stock updated successfully!';
                }

                if (!empty($_POST['mineral_id'])) {
                    $mineralId = $_POST['mineral_id'];
                    $mineralRepo->updateStock($mineralId, $newStock);
                    $message = 'Mineral stock updated successfully!';
                }
                break;

            case 'add_product':
                $result = addNewProduct($productRepo);
                if ($result['success']) {
                    $message = $result['message'];
                } else {
                    $error = $result['message'];
                }
                break;

            case 'add_mineral':
                $result = addNewMineral($mineralRepo);
                if ($result['success']) {
                    $message = $result['message'];
                } else {
                    $error = $result['message'];
                }
                break;

            case 'delete_product':
                $productId = $_POST['product_id'] ?? '';
                if (!empty($productId)) {
                    $result = $productRepo->deleteProduct($productId);
                    if ($result) {
                        $message = 'Product deleted successfully!';
                    } else {
                        $error = 'Failed to delete product. It may not exist or be referenced elsewhere.';
                    }
                } else {
                    $error = 'Please select a product to delete.';
                }
                break;

            case 'delete_mineral':
                $mineralId = $_POST['mineral_id'] ?? '';
                if (!empty($mineralId)) {
                    $result = $mineralRepo->deleteMineral($mineralId);
                    if ($result) {
                        $message = 'Mineral deleted successfully!';
                    } else {
                        $error = 'Failed to delete mineral. It may not exist or be referenced elsewhere.';
                    }
                } else {
                    $error = 'Please select a mineral to delete.';
                }
                break;
        }

        // Redirect to avoid form resubmission
        if ($message) {
            header('Location: /page/addstock/index.php?success=' . urlencode($message));
            exit;
        } elseif ($error) {
            header('Location: /page/addstock/index.php?error=' . urlencode($error));
            exit;
        }
    }

    return [
        'products' => $productRepo->getAllProducts(),
        'minerals' => $mineralRepo->getAllMinerals(),
        'message' => $_GET['success'] ?? '',
        'error' => $_GET['error'] ?? ''
    ];
}

function addNewProduct($productRepo): array
{
    try {
        $name = trim($_POST['product_name'] ?? '');
        $description = trim($_POST['product_description'] ?? '');
        $price = floatval($_POST['product_price'] ?? 0);
        $category = trim($_POST['product_category'] ?? '');
        $stock = intval($_POST['product_stock'] ?? 0);

        // Validation
        if (empty($name) || empty($category) || $price <= 0) {
            return ['success' => false, 'message' => 'Please fill all required fields with valid values.'];
        }

        // Handle image upload
        $imageName = '';
        if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = handleImageUpload($_FILES['product_image'], 'tools');
            if ($uploadResult['success']) {
                $imageName = $uploadResult['filename'];
            } else {
                return ['success' => false, 'message' => $uploadResult['message']];
            }
        }

        // Add product to database
        $result = $productRepo->addProduct($name, $description, $price, $category, $stock, $imageName);
        
        if ($result) {
            return ['success' => true, 'message' => "Product '$name' added successfully!"];
        } else {
            return ['success' => false, 'message' => 'Failed to add product to database.'];
        }

    } catch (Exception $e) {
        return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
    }
}

function addNewMineral($mineralRepo): array
{
    try {
        $name = trim($_POST['mineral_name'] ?? '');
        $origin = trim($_POST['mineral_origin'] ?? '');
        $type = trim($_POST['mineral_type'] ?? '');
        $description = trim($_POST['mineral_description'] ?? '');
        $price = floatval($_POST['mineral_price'] ?? 0);
        $stock = intval($_POST['mineral_stock'] ?? 0);

        // Validation
        if (empty($name) || empty($type) || $price <= 0) {
            return ['success' => false, 'message' => 'Please fill all required fields with valid values.'];
        }

        // Handle image upload
        $imageName = '';
        if (isset($_FILES['mineral_image']) && $_FILES['mineral_image']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = handleImageUpload($_FILES['mineral_image'], 'minerals');
            if ($uploadResult['success']) {
                $imageName = $uploadResult['filename'];
            } else {
                return ['success' => false, 'message' => $uploadResult['message']];
            }
        }

        // Add mineral to database
        $result = $mineralRepo->addMineral($name, $origin, $type, $description, $price, $stock, $imageName);
        
        if ($result) {
            return ['success' => true, 'message' => "Mineral '$name' added successfully!"];
        } else {
            return ['success' => false, 'message' => 'Failed to add mineral to database.'];
        }

    } catch (Exception $e) {
        return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
    }
}

function handleImageUpload($file, $type): array
{
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $maxSize = 5 * 1024 * 1024; // 5MB
    
    // Check file type
    if (!in_array($file['type'], $allowedTypes)) {
        return ['success' => false, 'message' => 'Invalid file type. Only JPG, PNG, and GIF files are allowed.'];
    }
    
    // Check file size
    if ($file['size'] > $maxSize) {
        return ['success' => false, 'message' => 'File too large. Maximum size is 5MB.'];
    }
    
    // Generate unique filename
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
    $filename = $originalName . '_' . uniqid() . '.' . $extension;
    
    // Set upload directory based on type
    $uploadDir = BASE_PATH . '/page/' . $type . '/assets/img/';
    
    // Create directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    $uploadPath = $uploadDir . $filename;
    
    // Ensure filename is unique
    $counter = 1;
    while (file_exists($uploadPath)) {
        $filename = $originalName . '_' . uniqid() . '_' . $counter . '.' . $extension;
        $uploadPath = $uploadDir . $filename;
        $counter++;
    }
    
    // Move uploaded file
    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        return ['success' => true, 'filename' => $filename];
    } else {
        return ['success' => false, 'message' => 'Failed to upload image.'];
    }
}
?>