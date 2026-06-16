<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASEURL; ?>css/auth.css">
    <title>Login</title>
</head>
<body>

    <div class="left-side">
        <h1>Shopify</h1>
        <p>
            Masuk ke akun kamu untuk melanjutkan belanja dengan mudah,
            cepat, dan aman.
        </p>
    </div>

    <div class="right-side">
        <div class="auth-card">

            <h2>Login</h2>
            <p>Masuk untuk mulai berbelanja.</p>

            <form action="<?= BASEURL; ?>auth/login" method="post">

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" placeholder="Masukkan email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="btn-register">
                    Login
                </button>

            </form>

            <div class="auth-footer">
                Belum punya akun?
                <a href="<?= BASEURL; ?>register.php">Register</a>
            </div>

        </div>
    </div>

</body>
</html>
