<?php
    session_start();

    if($_SESSION['is_login'] == false) {
        header('location:../auth/login.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <link rel="stylesheet" href="../css/analytics.css">
    <?php include "../includes/sidebar.php";?>
<div class="main-content">
        
        <div class="page-header">
            <h1>Analytics & Insight</h1>
            <p>Pantau statistik pergerakan barang dan efisiensi sistem Tuan Muda.</p>
        </div>

        <div class="analytics-grid">
            
            <div class="chart-box">
                <h2><i class="fa-solid fa-chart-bar"></i> Distribusi Barang Keluar (6 Bulan Terakhir)</h2>
                
                <div class="bar-chart-container">
                    <div class="bar-wrapper">
                        <div class="bar" style="height: 45%;">
                            <span class="bar-value">45</span>
                        </div>
                        <span class="bar-label">Jan</span>
                    </div>
                    <div class="bar-wrapper">
                        <div class="bar" style="height: 60%;">
                            <span class="bar-value">60</span>
                        </div>
                        <span class="bar-label">Feb</span>
                    </div>
                    <div class="bar-wrapper">
                        <div class="bar" style="height: 85%;">
                            <span class="bar-value">85</span>
                        </div>
                        <span class="bar-label">Mar</span>
                    </div>
                    <div class="bar-wrapper">
                        <div class="bar" style="height: 30%;">
                            <span class="bar-value">30</span>
                        </div>
                        <span class="bar-label">Apr</span>
                    </div>
                    <div class="bar-wrapper">
                        <div class="bar" style="height: 70%;">
                            <span class="bar-value">70</span>
                        </div>
                        <span class="bar-label">Mei</span>
                    </div>
                    <div class="bar-wrapper">
                        <div class="bar" style="height: 95%;">
                            <span class="bar-value">95</span>
                        </div>
                        <span class="bar-label">Jun</span>
                    </div>
                </div>
            </div>

            <div class="summary-box">
                <div>
                    <h2><i class="fa-solid fa-square-poll-vertical"></i> Skor Performa</h2>
                    <div class="stat-item">
                        <span class="stat-label">Efisiensi Stok</span>
                        <span class="stat-value up">+12.4% <i class="fa-solid fa-caret-up"></i></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Barang Rusak/Retur</span>
                        <span class="stat-value down">-2.1% <i class="fa-solid fa-caret-down"></i></span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Kecepatan Audit</span>
                        <span class="stat-value">0.8 Detik</span>
                    </div>
                </div>

                <div class="progress-container">
                    <div class="progress-label">
                        <span>Kapasitas Gudang Utama</span>
                        <strong>75%</strong>
                    </div>
                    <div class="progress-bar-bg">
                        <div class="progress-bar-fill"></div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</body>
</html>