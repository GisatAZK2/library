<?php

require_once __DIR__ . '/../core/Database.php';

class Book
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getinstace();
    }

    public function all()
    {
        return $this->db->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
    }


    public function create($data)
    {
        return $this->db->query(
            "INSERT INTO users (name, email) VALUES (?, ?)",
            [$data['name'], $data['email']]
        );
    }

    public function find($id)
{
    return $this->db
        ->query("SELECT * FROM users WHERE id = ?", [$id])
        ->fetch(PDO::FETCH_ASSOC);
}

public function findByLogin($login)
{
    return $this->db->query(
        "SELECT id AS id_user, name AS username, role, password 
         FROM users 
         WHERE email = ? OR name = ? 
         LIMIT 1",
        [$login, $login]
    )->fetch(PDO::FETCH_ASSOC);
}

public function update($id, $data)
{
    return $this->db->query(
        "UPDATE users SET name=?, email=? WHERE id=?",
        [$data['name'], $data['email'], $id]
    );
}

public function delete($id)
{
    return $this->db->query(
        "DELETE FROM users WHERE id=?",
        [$id]
    );
}

public function deleteMany($ids)
{
    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    return $this->db->query(
        "DELETE FROM users WHERE id IN ($placeholders)",
        $ids
    );
}
}
