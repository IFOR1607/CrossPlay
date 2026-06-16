<?php

class Controller {
    // Fungsi suci untuk memanggil file view/tampilan dari folder views
    public function view($view, $data = []) {
        require_once __DIR__ . '/../views/' . $view . '.php';
    }
}

?>
