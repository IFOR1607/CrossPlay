<?php
    session_start();
    require_once dirname(__DIR__) . '/database/db.php'; 


    if(isset($_SESSION['is_login'])) {
        header('Location:../dashboard/index.php');
        exit();
    }
        
    if(isset($_POST['register'])) {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = $conn -> query("INSERT INTO users (email,username,password) VALUES ('$email','$username','$password')");

        if($sql) {
        header("location: login.php");

        } else {
            echo 'gagal';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/auth_css/auth_stuff.css">
    <title>Login Form</title>
</head>
<body>

    <div class="login-container">
        <h2>Selamat Datang</h2>
        <form action="register.php" method="POST">

            <div class="input-group">
                <label for="username">email</label>
                <input type="text" id="email" name="email" placeholder="Masukkan email Anda" required>
            </div>

            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username Anda" required>
            </div>
            
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
            </div>

            <button type="submit" name="register" class="btn-login">Registrasi</button>
        </form>
        
        <div class="footer-text">
            sudah punya akun? <a href="login.php">Login sekarang</a>
        </div>
    </div>

</body>
</html>