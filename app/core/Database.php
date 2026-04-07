<?php

class Database {
    private static $instance = null;

    private $pdo;

    public function __construct() {
        $config = require __DIR__ . "/../../config/database.php";
        $this->pdo = new PDO(
            "mysql:host={$config['host']};dbname={$config['dbname']}",
            $config['username'],
            $config['password'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }

    public static function getinstace() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function query ($sql, $params=[]) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

}