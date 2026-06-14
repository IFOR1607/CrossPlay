<?php
// Bagian Logika Logout Tuan Muda
if(isset($_POST['logout'])) {
    session_unset();    
    session_destroy();
    header("location:../auth/login.php");
    exit();
}

// Mengambil nama file yang sedang dibuka saat ini (misal: index.php)
$halaman_sekarang = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Component</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/includes_css/sidebar.css">
</head>
<body>

    <div class="sidebar">
        <div>
            <div class="sidebar-brand">
                <i class="fa-solid fa-cube"></i>
                <span>CrossPlay.id</span>
            </div>

            <ul class="sidebar-menu">

                <li id="dashboard" class="<?= ($halaman_sekarang == 'index.php') ? 'active' : ''; ?>">
                    <a href="index.php">
                        <i class="fa-solid fa-chart-pie"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li id="inventaris" class="<?= ($halaman_sekarang == 'inventaris.php') ? 'active': ''; ?>">
                    <a href="inventaris.php">
                        <i class="fa-solid fa-boxes-stacked"></i>
                        <span>Inventaris</span>
                    </a>
                </li>

                <li id="category" class="<?= ($halaman_sekarang == 'manage-category.php') ? 'active' : ''; ?>">
                    <a href="manage-category.php">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                        <span>Manage Category</span>
                    </a>
                </li>

                <li id="analytics" class=" <?= ($halaman_sekarang == 'analytics.php') ? 'active' : ''; ?>">
                    <a href="analytics.php">
                        <i class="fa-solid fa-chart-line"></i>
                        <span>Analytics</span>
                    </a>
                </li>

                <li id="settings" class="<?= ($halaman_sekarang == 'pengaturan.php') ? 'active' : ''; ?>">
                    <a href="pengaturan.php">
                        <i class="fa-solid fa-gear"></i>
                        <span>Settings</span>
                    </a>
                </li>

            </ul>
        </div>

        <div class="sidebar-footer">
            <form action="" method="POST" class="logout-form">
                <button type="submit" name="logout" class="btn-logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </button> 
            </form>
        </div>
    </div>


    <script src="../js/sidebar.js"></script>
</body>
</html>