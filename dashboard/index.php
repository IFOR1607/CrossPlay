<?php
    session_start();
    ob_start();

if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== true) {
    header('location:../auth/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>dashboard</title>
</head>
<body>
    <?php include "../includes/sidebar.php";?>
<!-- 2. Area Konten Utama -->
    <div class="main-content">
    <!-- Profil -->
        <?php include "../includes/profile.php"; ?> 
        <!-- Header -->
        <div class="dashboard-header">
            <h1>Dashboard Sistem</h1>
            <p>Selamat datang kembali, Tuan Muda. Berikut adalah ringkasan performa sistem hari ini.</p>
        </div>

        <!-- Grid Kartu Informasi -->
        <?php include '../includes/common.php'; ?>

        <!-- Bagian Tabel Aktivitas -->
        <div class="data-section">
            <h2><i class="fa-solid fa-clock-rotate-left"></i> Aktivitas Terakhir</h2>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID Log</th>
                        <th>Aktivitas User</th>
                        <th>Waktu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#1024</td>
                        <td>Update stok barang gudang A</td>
                        <td>10:42 PM</td>
                        <td><span class="badge success">Sukses</span></td>
                    </tr>
                    <tr>
                        <td>#1023</td>
                        <td>Audit berkas berkala bulanan</td>
                        <td>09:15 PM</td>
                        <td><span class="badge success">Sukses</span></td>
                    </tr>
                    <tr>
                        <td>#1022</td>
                        <td>Percobaan login tidak dikenal (IP Terblokir)</td>
                        <td>08:02 PM</td>
                        <td><span class="badge warning">Peringatan</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>