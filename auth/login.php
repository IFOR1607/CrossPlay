<?php
    session_start();
    require_once dirname(__DIR__) . '/database/db.php'; 

    if(isset($_SESSION['is_login'])) {
        header('Location:../dashboard/index.php');
        exit();
    }



    if(isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = $conn -> query("SELECT * FROM users WHERE email='$email' AND password='$password'");
        $count = $sql -> num_rows;
        
        if($count > 0 ) {
            $data = $sql -> fetch_assoc();
            $_SESSION['username'] = $data['username'];
            $_SESSION['is_login'] = true ;
            header("location: ../dashboard/");

        } else {
            echo 'akun tidak ada';
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
        <form action="login.php" method="POST">

            <div class="input-group">
                <label for="username">email</label>
                <input type="text" id="email" name="email" placeholder="Masukkan email Anda" required>
            </div>
            
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
            </div>

            <button type="submit" name="login" class="btn-login">Masuk</button>
        </form>
        
        <div class="footer-text">
            Belum punya akun? <a href="register.php">Daftar sekarang</a>
        </div>
    </div>

</body>
</html>