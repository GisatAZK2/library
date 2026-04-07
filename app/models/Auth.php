<?php

require_once __DIR__ . "/../core/Database.php";

Class Auth {
    private $db;

    public function __construct() {
        $this->db = Database::getinstace();
    }

    public function insertanggota($data) {
        return $this->db->query("INSERT INTO tb_user (username, password) VALUES (?, ?)", [$data['username'],  password_hash($data['password'], PASSWORD_DEFAULT)]);
    }

    public function findByLogin($username)
{
    return $this->db->query(
        "SELECT id_user, username, password, role
         FROM tb_user 
         WHERE username = ?
         LIMIT 1",
        [$username]
    )->fetch(PDO::FETCH_ASSOC);
}



}

