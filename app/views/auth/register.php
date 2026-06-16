<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASEURL; ?>css/auth.css">
    <title>Register</title>
</head>
<body>

    <div class="left-side">
        <h1>Shopify</h1>
        <p>
            Bergabung sekarang dan nikmati pengalaman belanja yang mudah,
            cepat, dan aman dengan berbagai produk pilihan terbaik.
        </p>
    </div>

    <div class="right-side">
        <div class="auth-card">

            <h2>Create Account</h2>
            <p>Buat akun untuk mulai berbelanja.</p>

            <form action="<?= BASEURL; ?>auth/register" method="post">

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" placeholder="Masukkan email" required>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" name="username" type="text" placeholder="Masukkan username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="btn-register">
                    Register
                </button>

            </form>

            <div class="auth-footer">
                Sudah punya akun?
                <a href="<?= BASEURL; ?>login.php">Login</a>
            </div>

        </div>
    </div>

</body>
</html>
