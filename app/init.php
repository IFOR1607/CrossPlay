<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('BASEURL', 'http://localhost:8080');

// Panggil semua kru inti
require_once 'core/App.php';
require_once 'core/Controller.php';
require_once 'core/Database.php'; // <── [TAMBAHKAN BARIS INI]
