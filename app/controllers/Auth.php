<?php

class Auth extends Controller {
    
    public function index() {
        // 1. Panggil model 'User_model' dan minta data semua user
        // Fungsi $this->model() ini berasal dari warisan induknya (Controller.php)
        $data['user'] = $this->model('User_model')->getAllUsers();

        // 2. Kirim data tersebut ke halaman view jika dibutuhkan
        // (Untuk sekarang kita var_dump dulu untuk tes apakah koneksi Docker aman)
        echo "<h3>Hasil Tes Koneksi Database:</h3>";
        echo "<pre>";
        var_dump($data['user']);
        echo "</pre>";
    }

    public function login() {
        $this->view('auth/login');
    }

    public function register() {
        $this->view('auth/register');
    }
}