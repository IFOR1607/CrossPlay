<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/auth.css">
    <title>Login</title>
</head>
<body>

    <div class="left-side">
        <h1>CrossPlay</h1>
        <p>
            Bergabung sekarang dan nikmati pengalaman belanja yang mudah,
            cepat, dan aman dengan berbagai produk pilihan terbaik.
        </p>
    </div>

    <div class="right-side">
        <div class="auth-card">

            <h2>Login</h2>
            <p>Masuk ke akun kamu untuk melanjutkan.</p>

            <form action="" method="POST">
                <?php if (!empty($data['error'])) : ?>
                    <p class="auth-message error"><?= htmlspecialchars($data['error']); ?></p>
                <?php endif; ?>

                <?php if (!empty($data['success'])) : ?>
                    <p class="auth-message success"><?= htmlspecialchars($data['success']); ?></p>
                <?php endif; ?>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" placeholder="Masukkan email" name="email" value="<?= htmlspecialchars($data['form']['email'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" placeholder="Masukkan password" name="password" required>
                </div>

                <button type="submit" class="btn-register" name="login">
                    Login
                </button>

            </form>

            <div class="auth-footer">
                Belum punya akun?
                <a href="<?= BASEURL; ?>/auth/register">Register</a>
            </div>

        </div>
    </div>

</body>
</html>
