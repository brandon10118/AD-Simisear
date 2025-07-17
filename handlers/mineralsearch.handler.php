<?php

require_once UTILS_PATH . '/dbConnection.util.php';

class MineralRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllMinerals(): array
    {
        $stmt = $this->db->query("SELECT * FROM minerals ORDER BY name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchMinerals(string $search, string $type): array
    {
        $query = "SELECT * FROM minerals WHERE 1=1";
        $params = [];

        if (!empty($search)) {
            $query .= " AND name ILIKE :search";
            $params[':search'] = '%' . $search . '%';
        }

        if (!empty($type) && $type !== 'all') {
            $query .= " AND type = :type";
            $params[':type'] = $type;
        }

        $query .= " ORDER BY name";
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

function getSearchedMinerals(): array
{
    $db = getDatabaseConnection();
    $repo = new MineralRepository($db);

    $searchTerm = $_GET['search'] ?? '';
    $categoryFilter = $_GET['category'] ?? '';

    return $repo->searchMinerals($searchTerm, $categoryFilter);
}
