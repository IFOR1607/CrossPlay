<?php

class Controller {
    // Fungsi memanggil View HTML (yang sudah kita buat kemarin)
    public function view($view, $data = []) {
        require_once '../app/views/' . $view . '.php';
    }

    // 🎯 FUNGSI BARU: Fungsi sakti untuk memanggil Model
    public function model($model) {
        // Sedot file model yang diminta dari folder app/models/
        require_once '../app/models/' . $model . '.php';
        // Nyalakan kelas modelnya agar siap dipakai
        return new $model;
    }
}