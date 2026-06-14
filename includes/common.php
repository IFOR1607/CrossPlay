<?php 
    require_once dirname(__DIR__) . '/database/db.php'; 
    $sqlTotalProduk = $conn -> query("SELECT * FROM produk");
    $totalProduk = $sqlTotalProduk -> num_rows;
?>


<link rel="stylesheet" href="../css/includes_css/common.css">

<div class="card-grid">
            <div class="card">
                <div class="card-info">
                    <h3>Total Views</h3>
                    <div class="card-value">45,281</div>
                </div>
                <div class="card-icon">
                    <i class="fa-solid fa-eye"></i>
                </div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Total Profit</h3>
                    <div class="card-value">Rp 15.4M</div>
                </div>
                <div class="card-icon">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Total Produk</h3>
                    <div class="card-value"><?= $totalProduk ?></div>
                </div>
                <div class="card-icon">
                    <i class="fa-solid fa-box"></i>
                </div>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>Total Users</h3>
                    <div class="card-value">1,024</div>
                </div>
                <div class="card-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
        </div>