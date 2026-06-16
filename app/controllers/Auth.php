<?php

// Kelas Auth ini harus mewarisi sifat dari Controller utama kita
class Auth extends Controller {
    
    // Fungsi default yang akan dipanggil saat user mengakses /auth/login atau /auth
    public function index() {
        // Panggil file tampilan login.php yang ada di views/auth/
        $this->view('auth/login');
    }

    public function login() {
        $this->index();
    }

    public function register() {
        $this->view('auth/register');
    }
}
?>
