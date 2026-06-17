<?php

class App {
    protected $controller = 'Home'; 
    protected $method = 'index'; // Fungsi default jika user tidak menentukan aktivitas
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        // 1. CEK CONTROLLER
        if (isset($url[0])) {
            if (file_exists('../app/controllers/' . ucfirst($url[0]) . '.php')) {
                $this->controller = ucfirst($url[0]);
                unset($url[0]);
            }
        }

        // 2. PANGGIL FILE CONTROLLER-NYA
        require_once '../app/controllers/' . $this->controller . '.php';

        // 3. INSTANSIASI (Nyalakan Class-nya)
        $this->controller = new $this->controller;

        // 4. CEK METHOD: Apakah ada tulisan aktivitas di laci [1]?
        if (isset($url[1])) {
            // Kita cek: Apakah di dalam class controller tersebut ada fungsi/method yang dicari?
            if (method_exists($this->controller, $url[1])) {
                // Jika ADA, ganti method default kita dengan pilihan user
                $this->method = $url[1];
                // Hapus laci [1] dari array agar tersisa parameternya saja
                unset($url[1]);
            }
        }

        // 5. CEK PARAMETER: Apakah ada sisa data di laci berikutnya?
        if (!empty($url)) {
            // Ambil semua sisa laci URL dan masukkan ke dalam array properti params
            $this->params = array_values($url);
        }

        // 6. EKSEKUSI JALANKAN: Panggil controller & method, serta kirim parameternya
        // Ini fungsi bawaan PHP untuk menjalankan fungsi secara dinamis
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}