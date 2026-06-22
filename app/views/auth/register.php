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
        <h1>CrossPlay</h1>
        <p>
            Bergabung sekarang dan nikmati pengalaman belanja yang mudah,
            cepat, dan aman dengan berbagai produk pilihan terbaik.
        </p>
    </div>

    <div class="right-side">
        <div class="auth-card">

            <h2>Create Account</h2>
            <p>Buat akun untuk mulai berbelanja.</p>

            <form action="" method="POST">
                <?php if (!empty($data['error'])) : ?>
                    <p class="auth-message error"><?= htmlspecialchars($data['error']); ?></p>
                <?php endif; ?>

                <?php if (!empty($data['success'])) : ?>
                    <div class="register-success">
                        <img src="https://media.giphy.com/media/3o7TKJNFVZ4xCMriFy/giphy.gif" alt="Registrasi berhasil" class="success-gif">
                        <p class="auth-message success"><?= htmlspecialchars($data['success']); ?></p>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" placeholder="Masukkan email" name="email" value="<?= htmlspecialchars($data['form']['email'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" placeholder="Masukkan username" name="username" value="<?= htmlspecialchars($data['form']['username'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" placeholder="Masukkan password" name="password" minlength="6" required>
                </div>

                <button type="submit" class="btn-register" name="register">
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

<?php if (!empty($data['redirectTo'])) : ?>
    <script>
        setTimeout(function () {
            window.location.href = "<?= htmlspecialchars($data['redirectTo']); ?>";
        }, 2200);
    </script>
<?php endif; ?>
</html>
