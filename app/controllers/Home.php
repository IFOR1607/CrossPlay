<?php

class Home {
    
    // 1. Fungsi default (Wajib ada!)
    public function index() {
        echo "<br>🏠 [Method: index] Kamu sedang berada di halaman utama HOME!";
    }

    // 2. Fungsi detail untuk tes parameter
    public function detail($id = 0) {
        echo "<br>📦 [Method: detail] Kamu melihat produk dengan ID: " . $id;
    }
}