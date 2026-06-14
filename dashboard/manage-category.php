<?php
    session_start();
    require_once dirname(__DIR__) . '/database/db.php'; 
    if($_SESSION['is_login'] == false) {
        header('location:../auth/login.php');
        exit();
    }
    $messege_error = '';
$keluarkanDataProduk = $conn -> query("
                    SELECT
                        produk.id,
                        produk.nama AS nama_produk,
                        produk.harga,
                        produk.stok,
                        produk.ketersediaan_stok,
                        kategori.nama AS kategori_produk
                    FROM produk
                    INNER JOIN kategori ON produk.kategori_id = kategori.id
                        ");

// ==========================================
// 1. FITUR RENAME (UPDATE)
// ==========================================
if(isset($_POST['simpan_perubahan'])) {
    $namaKategori = $_POST['nama_kategori'];
    $idKategori= $_POST['id_kategori'];
    $sqlUpdate = "UPDATE kategori SET  nama = ? WHERE id = ? ";
    
    $stmt = $conn -> prepare($sqlUpdate);
    $stmt->bind_param("si",$namaKategori ,$idKategori);
    if($stmt->execute()) {
    }
}

// ==========================================
// 2. FITUR TAMBAH (INSERT)
// ==========================================
if(isset($_POST['tambahKategori'])) {
    $inputKatgori = $_POST['inputKategori'];
    
    $sqlKategori = "INSERT INTO kategori (nama) VALUE (?)";
    $stmt = $conn -> prepare($sqlKategori);
    $stmt -> bind_param('s',$inputKatgori);
    $stmt -> execute();
}

// ==========================================
// 3. FITUR HAPUS (DELETE)
// =========================================
if(isset($_POST['konfirmasi_hapus'])) {
    $delete_Kategori = $_POST['deleteKategori'];

    $sqlHapus = "DELETE FROM kategori WHERE id = ? ";
    $stmt = $conn -> prepare($sqlHapus);
    $stmt-> bind_param('i',$delete_Kategori);
    $stmt->execute();

    if($stmt->execute()) {
    }
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
    <link rel="stylesheet" href="../css/manage-category.css">
    <?php include "../includes/sidebar.php";?>

    <div class="main-content">
    
        <div class="category-container">
    

    <!-- HEADER -->
    <div class="category-header">
        <div class="header-title">
            <h1>Manage Categories</h1>
            <p>Kelola kategori produk toko online kamu di sini.</p>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa-solid fa-tags"></i>
            </div>
            <div class="stat-info">
                <span class="stat-label">Total Kategori</span>
                <span class="stat-value">12</span> </div>
        </div>
    </div>

    <!-- BTN KATEGORI -->
    <div class="category-actions">
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <!-- search box -->
            <input type="text" id="search-input" placeholder="Cari kategori...">
        </div>
        <button id="btnTambahKategori" class="btn-add-cat" name="tambah_kategori">
            <i class="fa-solid fa-plus"></i> Tambah Kategori
        </button>
    </div>

    <!-- TABEL -->
    <div class="table-wrapper">
        <?= $messege_error ?>
        <table class="category-table">
            <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Nama Kategori</th>
                    <th width="200px" class="text-center">Jumlah Produk</th> <th width="150px" class="text-center">Aksi</th> 
                </tr>
            </thead>
                <tbody id="tabel-produk">
                    <?php
                        $no = 1;
                        $sqlKategori = $conn->query("SELECT kategori.id, kategori.nama, COUNT(produk.id) AS total_prod 
                                                    FROM kategori 
                                                    LEFT JOIN produk ON kategori.id = produk.kategori_id 
                                                    GROUP BY kategori.id");
                        while($dataKategori = $sqlKategori -> fetch_assoc()){ ?>
                            <tr>
                                <td><strong><?= $no++ ?></strong></td>
                                <td><span class="category-name"><?= $dataKategori['nama'] ?></span></td>
                                <td class="text-center"><span class="prod-count"><?= $dataKategori['total_prod'] ?></span></td>
                                <td>
                                    <!-- Tombol -->
                                    <div class="cat-trigger-btns">
                                        <a href="#" 
                                        class="btn-cat-action edit" 
                                        data-id="<?= $dataKategori['id'] ?>" 
                                        data-nama="<?= $dataKategori['nama'] ?>" 
                                        title="Rename">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        
                                        <a href="#" 
                                        class="btn-cat-action delete" 
                                        data-id="<?= $dataKategori['id'] ?>" 
                                        data-nama="<?= $dataKategori['nama'] ?>" 
                                        title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        
                        <?php } ?>
                </tbody>
        </table>
    </div>

</div>

<!-- TAMBAH KATEGORI -->
<div id="modalKategori" class="cat-modal-overlay">
    <div class="cat-modal-content">
        <div class="cat-modal-header">
            <h2>Tambah Kategori Baru</h2>
            <span id="closeModalKategori" class="cat-close-btn">&minus;</span>
        </div>
        <form class="cat-modal-form" action="manage-category.php" method="POST">
            <div class="cat-form-group">
                <label for="nama_kategori">Nama Kategori</label>
                <input type="text" id="nama_kategori" name="inputKategori" placeholder="Contoh: Desk Setup, Smart Gadget..." required>
            </div>
            <div class="cat-modal-footer">
                <a href="manage-category.php" class="btn-cat-secondary" id="btnBatalKategori">Batal</a>
                <button type="submit" class="btn-cat-primary" name="tambahKategori">Simpan Kategori</button>
            </div>
        </form>
    </div>
</div>


<!-- POP UP RENAME -->
<div class="ren-modal-overlay">
    <div class="ren-modal-box">
        
        <div class="ren-modal-header">
            <h3 class="ren-modal-title">Ubah Nama Kategori</h3>
            <a href="manage-category.php" class="ren-modal-close-x">&times;</a>
        </div>
        
        <form action="manage-category.php" method="POST">
            <div class="ren-form-group">
                <label class="ren-form-label">Nama Kategori</label>
                <input type="text" id="namaKategori" name="nama_kategori" required class="ren-form-input">
                <input type="hidden" id="edit-id" name="id_kategori">
            </div>
            
            <div class="ren-modal-footer-btns">
                <a href="manage-category.php" class="btn-ren-cancel">Batal</a>
                <button type="submit" name="simpan_perubahan" class="btn-ren-save">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>



<!-- POP UP DELETE -->
<div class="del-modal-overlay">
    <div class="del-modal-box">
        
        <div class="del-icon-alert">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        
        <h3 class="del-modal-title" style="margin-bottom: 8px;">Hapus Kategori?</h3>
        <p class="del-body-text">
            Apakah kamu yakin ingin menghapus kategori <strong id="nama-kategori-hapus"></strong>? Data produk di dalam kategori ini mungkin akan terpengaruh.
        </p>
        
        <form action="manage-category.php" method="POST">
            <input type="hidden" id="delete-kategori" name="deleteKategori" >
            <div class="del-modal-footer-btns">
                <a href="manage-category.php" class="btn-del-cancel">Batal</a>
                <button type="submit" name="konfirmasi_hapus" class="btn-del-confirm">Ya, Hapus</button>
            </div>
        </form>
        
    </div>
</div>



    </div>

    <script src="../js/manage-category.js"></script>

</body>
</html>