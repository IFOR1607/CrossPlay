<?php

class Auth extends Controller {
    public function login() {
        if (isset($_POST['login'])) {
            $dataForm = [
                'email' => trim($_POST['email'] ?? ''),
                'password' => $_POST['password'] ?? '',
            ];

            $data = [
                'form' => [
                    'email' => $dataForm['email'],
                ],
                'error' => '',
                'success' => '',
            ];

            if ($dataForm['email'] === '' || $dataForm['password'] === '') {
                $data['error'] = 'Email dan password wajib diisi.';
                $this->view('auth/login', $data);
                return;
            }

            $user = $this->model('User_model')->getUserByEmail($dataForm['email']);

            if (!$user || !password_verify($dataForm['password'], $user['password'])) {
                $data['error'] = 'Email atau password salah.';
                $this->view('auth/login', $data);
                return;
            }

            $_SESSION['user'] = [
                'id' => $user['id'],
                'email' => $user['email'],
                'username' => $user['username'],
            ];

            header('Location: ' . BASEURL . '/dashboard');
            exit;
        }

        $this->view('auth/login', [
            'form' => [
                'email' => '',
            ],
            'error' => '',
            'success' => $_SESSION['success'] ?? '',
        ]);

        unset($_SESSION['success']);
    }

    public function register() {
        if (isset($_POST['register'])) {
            $dataForm = [
                'email' => trim($_POST['email'] ?? ''),
                'username' => trim($_POST['username'] ?? ''),
                'password' => $_POST['password'] ?? '',
            ];

            $data = [
                'form' => [
                    'email' => $dataForm['email'],
                    'username' => $dataForm['username'],
                ],
                'error' => '',
                'success' => '',
            ];

            if ($dataForm['email'] === '' || $dataForm['username'] === '' || $dataForm['password'] === '') {
                $data['error'] = 'Semua field wajib diisi.';
                $this->view('auth/register', $data);
                return;
            }

            if (!filter_var($dataForm['email'], FILTER_VALIDATE_EMAIL)) {
                $data['error'] = 'Format email belum valid.';
                $this->view('auth/register', $data);
                return;
            }

            if (strlen($dataForm['password']) < 6) {
                $data['error'] = 'Password minimal 6 karakter.';
                $this->view('auth/register', $data);
                return;
            }

            $userModel = $this->model('User_model');

            if ($userModel->getUserByEmail($dataForm['email'])) {
                $data['error'] = 'Email sudah terdaftar.';
                $this->view('auth/register', $data);
                return;
            }

            if ($userModel->tambahUser($dataForm) > 0) {
                $data['form'] = [
                    'email' => '',
                    'username' => '',
                ];
                $data['success'] = 'Registrasi berhasil. Kamu akan diarahkan ke login.';
                $data['redirectTo'] = BASEURL . '/auth/login';
                $this->view('auth/register', $data);
                return;
            }

            $data['error'] = 'Registrasi gagal. Coba lagi.';
            $this->view('auth/register', $data);
            return;
        }

        $this->view('auth/register', [
            'form' => [
                'email' => '',
                'username' => '',
            ],
            'error' => '',
            'success' => '',
            'redirectTo' => '',
        ]);
    }

    public function logout() {
        session_unset();
        session_destroy();

        header('Location: ' . BASEURL . '/auth/login');
        exit;
    }
}
