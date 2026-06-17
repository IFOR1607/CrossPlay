<?php

class Database {
    // Setelan koneksi database Docker kamu
    private $host = 'db'; // Di Docker Compose biasanya nama servicenya 'db' atau 'localhost'
    private $user = 'root';
    private $pass = 'root'; // Sesuaikan dengan password di docker-compose.yml kamu
    private $db_name = 'crossplay'; // Sesuaikan dengan nama database proyekmu

    private $dbh; // Database Handler
    private $stmt; // Statement untuk query

    public function __construct() {
        // Data Source Name (Alamat sumber data)
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;

        // Setelan tambahan agar PDO berjalan optimal dan aman
        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            // Jalankan koneksi database
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
        } catch (PDOException $e) {
            // Jika gagal konek, hentikan aplikasi dan munculkan error-nya
            die("Koneksi Database Gagal: " . $e->getMessage());
        }
    }

    // Fungsi pembantu untuk menulis query SQL nantinya
    public function query($query) {
        $this->stmt = $this->dbh->prepare($query);
    }

    // Fungsi untuk mengikat data (Binding) agar aman dari SQL Injection
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Eksekusi query
    public function execute() {
        $this->stmt->execute();
    }

    // Ambil semua data hasil query (Banyak baris)
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil hanya satu baris data saja (Cocok untuk login/cek data)
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
}