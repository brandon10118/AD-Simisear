# Database Content Documentation

## Products Table Structure
The products table contains the following columns:
- `id` (UUID) - Primary key, auto-generated
- `name` (VARCHAR 255) - Product name 
- `description` (TEXT) - Product description
- `price` (NUMERIC 10,2) - Product price
- `category` (VARCHAR 100) - Product category (pickaxes, shovels, drills, helmets, tnt)
- `stock` (INTEGER) - Current stock amount
- `image` (VARCHAR 255) - Image filename

### Sample Products Data:
```sql
INSERT INTO products (name, description, price, category, stock, image) VALUES
('Poseidon''s Pickaxe', 'A mythical pickaxe blessed by Poseidon.', 120.00, 'pickaxes', 10, 'pos.jpg'),
('Hermes'' Swift Pick', 'A lightweight pickaxe for quick mining.', 110.00, 'pickaxes', 10, 'Hermes.jpg'),
('Atlas'' Heavy Pickaxe', 'Extremely powerful and durable.', 130.00, 'pickaxes', 10, 'Atlas.jpg'),
('Hades'' Shovel', 'Forged in the underworld.', 80.00, 'shovels', 10, 'Hades.jpg'),
('Athena''s Drill', 'Designed with divine strategy.', 150.00, 'drills', 10, 'athena.jpg'),
('Ares'' Helmet', 'Provides ultimate battle protection.', 60.00, 'helmets', 10, 'ares.jpg'),
('Zeus'' TNT', 'Thunderous explosive power.', 100.00, 'tnt', 10, 'zeus.jpg');
```

## Minerals Table Structure
The minerals table contains the following columns:
- `id` (UUID) - Primary key, auto-generated
- `name` (VARCHAR 255) - Mineral name
- `origin` (VARCHAR 255) - Where the mineral originates from
- `type` (VARCHAR 100) - Mineral type (gemstone, ore, rock, mineral)
- `description` (TEXT) - Mineral description
- `image` (VARCHAR 255) - Image filename
- `price` (NUMERIC 10,2) - Mineral price
- `stock` (INTEGER) - Current stock amount

### Sample Minerals Data:
```sql
INSERT INTO minerals (name, origin, type, description, image, price, stock) VALUES
('Amethyst', 'Greece', 'gemstone', 'A violet variety of quartz prized in ancient Greece.', 'amethyst.jpg', 100.00, 10),
('Hematite', 'Thrace', 'ore', 'Iron oxide mineral used by Greeks as a pigment.', 'hematite.jpg', 80.00, 10),
('Malachite', 'Laurion Mines', 'gemstone', 'Green copper carbonate mineral used in ancient Greek jewelry and paint.', 'malachite.jpg', 120.00, 10),
('Galena', 'Laurion', 'ore', 'Lead ore that was extensively mined in ancient Greece.', 'galena.jpg', 90.00, 10),
('Marble', 'Penteli', 'rock', 'White marble from Mount Pentelicus used in the Parthenon.', 'marble.jpg', 200.00, 5),
('Obsidian', 'Milos Island', 'rock', 'Volcanic glass used for tools and weapons.', 'obsidian.jpg', 75.00, 15);
```

## Using the Admin Interface

### Adding New Products:
1. Go to Add Stock page (admin access required)
2. Click "Add New Product" tab
3. Fill in all required fields:
   - Product Name (required)
   - Description (optional)
   - Price (required, > 0)
   - Category (required: pickaxes, shovels, drills, helmets, tnt)
   - Initial Stock (required, >= 0)
   - Image (optional: JPG, PNG, GIF, max 5MB)
4. Click "Add Product"

### Adding New Minerals:
1. Go to Add Stock page (admin access required)
2. Click "Add New Mineral" tab
3. Fill in all required fields:
   - Mineral Name (required)
   - Origin (optional)
   - Type (required: gemstone, ore, rock, mineral)
   - Description (optional)
   - Price (required, > 0)
   - Initial Stock (required, >= 0)
   - Image (optional: JPG, PNG, GIF, max 5MB)
4. Click "Add Mineral"

### Image Upload:
- Images are uploaded to `/page/tools/assets/img/` for products
- Images are uploaded to `/page/minerals/assets/img/` for minerals
- Filenames are made unique with timestamps to prevent conflicts
- Supported formats: JPG, PNG, GIF
- Maximum file size: 5MB

### Stock Updates:
- Use the "Update Stock" tab to add inventory to existing products/minerals
- Select the item from the dropdown (shows current stock)
- Enter the amount to ADD to current stock
- Stock updates are additive (current stock + new amount)
