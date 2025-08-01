<?php
// connecting pages to Product db
class ProductRepository {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM products ORDER BY name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStock($productId, $additionalStock) {
        $stmt = $this->db->prepare("
        UPDATE products 
        SET stock = stock + :additional 
        WHERE id = :id"
    );    
        return $stmt->execute([
            ':additional' => $additionalStock,
            ':id' => $productId
    ]);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllProducts(): array {
    $stmt = $this->db->query("SELECT * FROM products ORDER BY name ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchProducts(string $search = '', string $category = ''): array {
    $sql = "SELECT * FROM products WHERE 1=1";

    $params = [];

    if ($search !== '') {
        $sql .= " AND name ILIKE :search";
        $params[':search'] = '%' . $search . '%';
    }

    if ($category !== '' && $category !== 'all') {
        $sql .= " AND category = :category";
        $params[':category'] = $category;
    }

    $stmt = $this->db->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function addProduct(string $name, string $description, float $price, string $category, int $stock, string $image = ''): bool {
        $stmt = $this->db->prepare("
            INSERT INTO products (name, description, price, category, stock, image) 
            VALUES (:name, :description, :price, :category, :stock, :image)
        ");
        
        return $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':price' => $price,
            ':category' => $category,
            ':stock' => $stock,
            ':image' => $image
        ]);
    }

    public function deleteProduct($productId): bool {
        try {
            $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
            return $stmt->execute([':id' => $productId]);
        } catch (PDOException $e) {
            error_log("Failed to delete product: " . $e->getMessage());
            return false;
        }
    }


}

class MineralRepository {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM minerals WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getAllMinerals() {
        $stmt = $this->db->query("SELECT * FROM minerals ORDER BY name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStock($mineralId, $additionalStock) {
        $stmt = $this->db->prepare("
            UPDATE minerals 
            SET stock = stock + :additional 
            WHERE id = :id"
        );
        return $stmt->execute([
            ':additional' => $additionalStock,
            ':id' => $mineralId
        ]);
    }

    public function addMineral(string $name, string $origin, string $type, string $description, float $price, int $stock, string $image = ''): bool {
        $stmt = $this->db->prepare("
            INSERT INTO minerals (name, origin, type, description, price, stock, image) 
            VALUES (:name, :origin, :type, :description, :price, :stock, :image)
        ");
        
        return $stmt->execute([
            ':name' => $name,
            ':origin' => $origin,
            ':type' => $type,
            ':description' => $description,
            ':price' => $price,
            ':stock' => $stock,
            ':image' => $image
        ]);
    }

    public function deleteMineral($mineralId): bool {
        try {
            $stmt = $this->db->prepare("DELETE FROM minerals WHERE id = :id");
            return $stmt->execute([':id' => $mineralId]);
        } catch (PDOException $e) {
            error_log("Failed to delete mineral: " . $e->getMessage());
            return false;
        }
    }
}

class CartRepository {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function getUserCartItems($userId) {
        $stmt = $this->db->prepare("
            SELECT c.product_id, c.quantity, c.price, p.name, p.image, p.category
            FROM carts c
            JOIN products p ON c.product_id = p.id
            WHERE c.user_id = :user_id
        ");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCartTotal($userId) {
        $stmt = $this->db->prepare("
            SELECT SUM(c.quantity * c.price) as total
            FROM carts c
            WHERE c.user_id = :user_id
        ");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchColumn();
    }
}


?>