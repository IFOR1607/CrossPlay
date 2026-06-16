<?php

class App {
    // Menentukan halaman default jika user hanya mengetik localhost:8080/
    protected $controller = 'Auth';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();
        $url = $this->normalizeURL($url);
        
        // 1. MEMILIH CONTROLLER
        // Cek apakah ada file controller yang sesuai dengan ketikan URL kata pertama
        if (isset($url[0])) {
            if (file_exists(__DIR__ . '/../controllers/' . ucfirst($url[0]) . '.php')) {
                $this->controller = ucfirst($url[0]);
                unset($url[0]);
            }
        }

        // Panggil filenya dan instansiasi (buat objek baru)
        require_once __DIR__ . '/../controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // 2. MEMILIH METHOD (Aksi di dalam Controller)
        // Cek apakah ada kata kedua di URL untuk dijadikan fungsi/method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // 3. MENGAMBIL PARAMETER (Jika ada sisa URL seperti ID Produk dll)
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        // Jalankan controller & method, serta kirimkan params jika ada
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function normalizeURL($url)
    {
        if (empty($url[0])) {
            return $url;
        }

        $firstSegment = strtolower($url[0]);
        $aliases = [
            'login.php' => ['auth', 'index'],
            'register.php' => ['auth', 'register'],
        ];

        if (isset($aliases[$firstSegment])) {
            return $aliases[$firstSegment];
        }

        if (substr($firstSegment, -4) === '.php') {
            $url[0] = substr($firstSegment, 0, -4);
        }

        return $url;
    }

    // Fungsi suci untuk membersihkan URL dari karakter aneh dan memecahnya jadi array
    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        return [];
    }
}
