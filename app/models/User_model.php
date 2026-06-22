<?php

class User_model {
    private $table = 'users';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getUserByEmail($email) {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";

        $this->db->query($query);
        $this->db->bind('email', $email);

        return $this->db->single();
    }

    public function tambahUser($data) {
        $query = "INSERT INTO " . $this->table . " (email, username, password) VALUES (:email, :username, :password)";

        $this->db->query($query);
        $this->db->bind('email', $data['email']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));

        $this->db->execute();

        return $this->db->rowCount();
    }
}
