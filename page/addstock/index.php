<?php
require_once BASE_PATH . '/bootstrap.php';
require_once HANDLERS_PATH . '/stockUpdate.handler.php';
require_once LAYOUT_PATH . '/main.layout.php';
require_once COMPONENT_PATH . '/componentGroup/navbar.component.php';
require_once COMPONENT_PATH . '/componentGroup/footer.component.php';

// Ensure $products and $minerals are defined
$products = isset($products) ? $products : [];
$minerals = isset($minerals) ? $minerals : [];

extract(handleStockUpdate());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Admin - Stock Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Cormorant+Garamond:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/page/addstock/asset/css/style.css">
</head>
<body>
<nav>
    <?= getNavbar('Add Stock'); ?>
</nav>
<main class="container">
    <?php if (!empty($message)): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>
    
    <?php if (!empty($error)): ?>
        <div class="alert alert-error">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <div class="tabs">
        <button class="tab-button active" onclick="openTab(event, 'update-stock')">Update Stock</button>
        <button class="tab-button" onclick="openTab(event, 'add-product')">Add New Product</button>
        <button class="tab-button" onclick="openTab(event, 'add-mineral')">Add New Mineral</button>
        <button class="tab-button" onclick="openTab(event, 'delete-product')">Delete Product</button>
        <button class="tab-button" onclick="openTab(event, 'delete-mineral')">Delete Mineral</button>
    </div>

    <!-- Update Stock Tab -->
    <div id="update-stock" class="tab-content active">
        <h2>Update Stocks</h2>
        <form method="POST" class="stock-form">
            <input type="hidden" name="action" value="update_stock">
            
            <div class="form-row">
                <div class="form-group">
                    <h3>Product Stock</h3>
                    <select name="product_id">
                        <option disabled selected>Select a Product</option>
                        <?php foreach ($products as $product): ?>
                            <option value="<?= $product['id'] ?>">
                                <?= htmlspecialchars($product['name']) ?> (Current: <?= $product['stock'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <h3>Mineral Stock</h3>
                    <select name="mineral_id">
                        <option disabled selected>Select a Mineral</option>
                        <?php foreach ($minerals as $mineral): ?>
                            <option value="<?= $mineral['id'] ?>">
                                <?= htmlspecialchars($mineral['name']) ?> (Current: <?= $mineral['stock'] ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="stock">New Stock to Add:</label>
                <input type="number" name="stock" min="0" required>
            </div>

            <button type="submit">Update Stock</button>
        </form>
    </div>

    <!-- Add New Product Tab -->
    <div id="add-product" class="tab-content">
        <h2>Add New Product</h2>
        <form method="POST" enctype="multipart/form-data" class="add-form">
            <input type="hidden" name="action" value="add_product">
            
            <div class="form-row">
                <div class="form-group">
                    <label for="product_name">Product Name:</label>
                    <input type="text" name="product_name" id="product_name" required>
                </div>
                <div class="form-group">
                    <label for="product_category">Category:</label>
                    <select name="product_category" id="product_category" required>
                        <option value="">Select Category</option>
                        <option value="pickaxes">Pickaxes</option>
                        <option value="shovels">Shovels</option>
                        <option value="drills">Drills</option>
                        <option value="helmets">Helmets</option>
                        <option value="tnt">TNT</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="product_description">Description:</label>
                <textarea name="product_description" id="product_description" rows="4"></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="product_price">Price ($):</label>
                    <input type="number" name="product_price" id="product_price" step="0.01" min="0" required>
                </div>
                <div class="form-group">
                    <label for="product_stock">Initial Stock:</label>
                    <input type="number" name="product_stock" id="product_stock" min="0" value="0" required>
                </div>
            </div>

            <div class="form-group">
                <label for="product_image">Product Image (Optional):</label>
                <input type="file" name="product_image" id="product_image" accept="image/*">
                <small>Supported formats: JPG, PNG, GIF. Max size: 5MB</small>
            </div>

            <button type="submit">Add Product</button>
        </form>
    </div>

    <!-- Add New Mineral Tab -->
    <div id="add-mineral" class="tab-content">
        <h2>Add New Mineral</h2>
        <form method="POST" enctype="multipart/form-data" class="add-form">
            <input type="hidden" name="action" value="add_mineral">
            
            <div class="form-row">
                <div class="form-group">
                    <label for="mineral_name">Mineral Name:</label>
                    <input type="text" name="mineral_name" id="mineral_name" required>
                </div>
                <div class="form-group">
                    <label for="mineral_type">Type:</label>
                    <select name="mineral_type" id="mineral_type" required>
                        <option value="">Select Type</option>
                        <option value="gemstone">Gemstone</option>
                        <option value="ore">Ore</option>
                        <option value="rock">Rock</option>
                        <option value="mineral">Mineral</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="mineral_origin">Origin:</label>
                <input type="text" name="mineral_origin" id="mineral_origin">
            </div>

            <div class="form-group">
                <label for="mineral_description">Description:</label>
                <textarea name="mineral_description" id="mineral_description" rows="4"></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="mineral_price">Price ($):</label>
                    <input type="number" name="mineral_price" id="mineral_price" step="0.01" min="0" required>
                </div>
                <div class="form-group">
                    <label for="mineral_stock">Initial Stock:</label>
                    <input type="number" name="mineral_stock" id="mineral_stock" min="0" value="0" required>
                </div>
            </div>

            <div class="form-group">
                <label for="mineral_image">Mineral Image (Optional):</label>
                <input type="file" name="mineral_image" id="mineral_image" accept="image/*">
                <small>Supported formats: JPG, PNG, GIF. Max size: 5MB</small>
            </div>

            <button type="submit">Add Mineral</button>
        </form>
    </div>

    <!-- Delete Product Tab -->
    <div id="delete-product" class="tab-content">
        <h2>Delete Product</h2>
        <form method="POST" class="delete-form">
            <input type="hidden" name="action" value="delete_product">
            
            <div class="form-group">
                <label for="delete_product_id">Select Product to Delete:</label>
                <select name="product_id" id="delete_product_id" required>
                    <option value="">Choose a product...</option>
                    <?php foreach ($products as $product): ?>
                        <option value="<?= $product['id'] ?>">
                            <?= htmlspecialchars($product['name']) ?> - $<?= number_format($product['price'], 2) ?> (Stock: <?= $product['stock'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="warning-box">
                <i class="fas fa-exclamation-triangle"></i>
                <p><strong>Warning:</strong> This action cannot be undone. The product will be permanently removed from the database.</p>
            </div>

            <button type="submit" class="delete-btn" onclick="return confirmDelete('product')">Delete Product</button>
        </form>
    </div>

    <!-- Delete Mineral Tab -->
    <div id="delete-mineral" class="tab-content">
        <h2>Delete Mineral</h2>
        <form method="POST" class="delete-form">
            <input type="hidden" name="action" value="delete_mineral">
            
            <div class="form-group">
                <label for="delete_mineral_id">Select Mineral to Delete:</label>
                <select name="mineral_id" id="delete_mineral_id" required>
                    <option value="">Choose a mineral...</option>
                    <?php foreach ($minerals as $mineral): ?>
                        <option value="<?= $mineral['id'] ?>">
                            <?= htmlspecialchars($mineral['name']) ?> (<?= htmlspecialchars($mineral['type']) ?>) - $<?= number_format($mineral['price'], 2) ?> (Stock: <?= $mineral['stock'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="warning-box">
                <i class="fas fa-exclamation-triangle"></i>
                <p><strong>Warning:</strong> This action cannot be undone. The mineral will be permanently removed from the database.</p>
            </div>

            <button type="submit" class="delete-btn" onclick="return confirmDelete('mineral')">Delete Mineral</button>
        </form>
    </div>
</main>
<script>
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    
    // Hide all tab content
    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].classList.remove("active");
    }
    
    // Remove active class from all tab buttons
    tablinks = document.getElementsByClassName("tab-button");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
    }
    
    // Show selected tab and mark button as active
    document.getElementById(tabName).classList.add("active");
    evt.currentTarget.classList.add("active");
    
    // Smooth scroll to tab content on mobile
    if (window.innerWidth <= 768) {
        document.getElementById(tabName).scrollIntoView({ 
            behavior: 'smooth', 
            block: 'start' 
        });
    }
}

// Handle form validation
document.addEventListener('DOMContentLoaded', function() {
    // Add form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.style.borderColor = '#dc3545';
                    isValid = false;
                } else {
                    field.style.borderColor = '#c1a35f';
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Please fill in all required fields.');
            }
        });
    });
    
    // File upload preview
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const maxSize = 5 * 1024 * 1024; // 5MB
                if (file.size > maxSize) {
                    alert('File size must be less than 5MB');
                    e.target.value = '';
                    return;
                }
                
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Only JPG, PNG, and GIF files are allowed');
                    e.target.value = '';
                    return;
                }
            }
        });
    });
});

// Delete confirmation function
function confirmDelete(itemType) {
    const itemName = itemType === 'product' ? 
        document.getElementById('delete_product_id').selectedOptions[0]?.text || 'this product' :
        document.getElementById('delete_mineral_id').selectedOptions[0]?.text || 'this mineral';
    
    return confirm(`Are you sure you want to delete ${itemName}?\n\nThis action cannot be undone and will permanently remove the item from the database.`);
}
</script>
</body>
</html>