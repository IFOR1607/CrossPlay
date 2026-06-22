<?php

class Dashboard extends Controller {
    public function index() {
        if (empty($_SESSION['user'])) {
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }

        $this->view('dashboard/index', [
            'user' => $_SESSION['user'],
        ]);
    }
}
