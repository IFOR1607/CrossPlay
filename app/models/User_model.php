<?php

class User_model {
    private $table = 'users'; // Nama tabel di database kamu
    private $db;

    public function __construct() {
        // Otomatis menyalakan mesin pompa database yang ada di core
        $this->db = new Database;
    }

    // Contoh fungsi untuk mengambil semua data user (hanya untuk tes koneksi)
    public function getAllUsers() {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }
}