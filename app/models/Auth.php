<?php

require_once __DIR__ . "/../core/Database.php";

Class Auth {
    private $db;

    public function __construct() {
        $this->db = Database::getinstace();
    }

    public function insertanggota($data) {
        return $this->db->query("INSERT INTO TABLE tb_user (username, password) VALUES (?, ?)", [$data['username'], $data['password']]);
    }

}

