<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/auth.css">
    <title>Dashboard</title>
</head>
<body class="dashboard-page">
    <main class="dashboard-box">
        <p>Halo, <?= htmlspecialchars($data['user']['username'] ?? 'User'); ?></p>
        <h1>Hello World</h1>
        <a href="<?= BASEURL; ?>/auth/logout">Logout</a>
    </main>
</body>
</html>
