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

 
}

