<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/auth.css">
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

            <form>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" placeholder="Masukkan email">
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" placeholder="Masukkan username">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" placeholder="Masukkan password">
                </div>

                <button type="submit" class="btn-register">
                    Register
                </button>

            </form>

            <div class="auth-footer">
                Sudah punya akun?
                <a href="<?= BASEURL; ?>/auth/login">login</a>
            </div>

        </div>
    </div>

</body>
</html>
