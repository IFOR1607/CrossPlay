<?php
    session_start();
    require_once dirname(__DIR__) . '/database/db.php'; 
    $messege_error = '';
    if($_SESSION['is_login'] == false) {
        header('location:../auth/login.php');
        exit(); 
    }


    if(isset($_POST['submit_produk'])) {
        $kategori_id= $_POST['kategori_id'];
        $namaProduk = $_POST['nama'];
        $hargaProduk = $_POST['harga'];
        $stokProduk = $_POST['stok'];
        $deskripsiProduk = $_POST['detail'];

        $nama_foto = $_FILES['foto']['name'];
        $lokasi_foto = $_FILES['foto']['tmp_name'];
        $lokasi_tujuan = "../img/produk/" . $nama_foto;


        $sql = $conn -> query("INSERT INTO produk (kategori_id,nama,harga,stok,foto,detail) VALUES ('$kategori_id','$namaProduk','$hargaProduk','$stokProduk','$nama_foto','$deskripsiProduk')");
        if($sql) {
            move_uploaded_file($lokasi_foto,$lokasi_tujuan);
            $messege_error = 'data berhasil masuk';
            
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <link rel="stylesheet" href="../css/inventaris.css">
    <?php include "../includes/sidebar.php";?>


<div class="main-content">
        
        <div class="page-header" id="tambahBarang">
            <h1>Daftar Inventaris</h1>
            <a href="#" class="btn-add">
                <i class="fa-solid fa-plus"></i> Tambah Barang
            </a>
        </div>

        <div class="inventory-toolbar">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="search-input" placeholder="Cari nama atau kode barang...">
            </div>
            <div style="color: #7f8c8d; font-size: 14px;">
                Menampilkan 3 tipe aset
            </div>
        </div>

        <div class="table-container">
            <table class="inventory-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Jumlah Stok</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="table-produk">
                    <!-- DATA PRODUK DINAMIS -->
                    <?php
                        $no = 1;
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
                        while($dataProduk = $keluarkanDataProduk -> fetch_assoc()) {

                        if ($dataProduk['stok'] == 0 || $dataProduk['ketersediaan_stok'] == 'habis') {
                            // Produk otomatis HABIS kalau stoknya 0, ATAU kalau admin sengaja mengubah statusnya jadi 'habis' di database
                            $status = "habis";
                            $classWarna = 'out';
                            } elseif ($dataProduk['stok'] <= 50) {
                                $status = "kritis";
                                $classWarna = 'low';
                                } else {
                                    $status = "tersedia";
                                    $classWarna = 'instock';
                        }
                    ?>
                    <tr>
                        <td><strong><?= $no++ ?></strong></td>
                        <td><?= $dataProduk['nama_produk'] ?></td>
                        <td><?= "Rp " . number_format($dataProduk['harga'], 0, ",", ".");
                        ?></td>
                        <td><?= $dataProduk['kategori_produk']; ?></td>
                        <td><?= $dataProduk['stok'] ?></td>
                        <td><span class="stock-badge <?php echo $classWarna ?>"><?= $status ?></span></td>
                        <td>
                            <div class="action-btns">
                                <a href="edit-mode/edit-produk/edit-produk.php?id=<?= $dataProduk['id'];?>" class="btn-action edit"><i class="fa-solid fa-pen"></i></a>
                                <a href="edit-mode/edit-produk/delete-produk.php?id=<?= $dataProduk['id']; ?>"class="btn-action delete"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </td>   
                    </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>

    
    <!-- FORM INPUT BARANG -->
<div id="modalProduk" class="modal-overlay">
    
    <div class="modal-content">
        <div class="modal-header" id="minimize">
            <h2>Tambah Produk Baru</h2>
            <span id="btnTutupModal" class="close-btn">&times;</span>
        </div>
        
        <form action="inventaris.php" method="POST" enctype="multipart/form-data" class="modal-form">
            
            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" id="nama_produk" name="nama" placeholder="Masukkan nama produk..." required>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="harga_produk">Harga (Rp)</label>
                    <input type="number" id="harga_produk" name="harga" placeholder="Contoh: 150000" required>
                </div>
                <div class="form-group">
                    <label for="stok_produk">Jumlah Stok</label>
                    <input type="number" id="stok_produk" name="stok" placeholder="Contoh: 100" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="kategori_id">Kategori</label>
                    <select id="kategori_id" name="kategori_id" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php
                            $sqlKategori = $conn -> query("SELECT * FROM kategori");
                            while($kat = $sqlKategori -> fetch_assoc()) {
                                echo "<option value='".$kat['id']."'>".$kat['nama']."</option>";
                            }?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ketersediaan_stok">Hide Mode</label>
                    <select id="ketersediaan_stok" name="ketersediaan_stok" required>
                        <option value="tersedia">Sembunyikan</option>
                        <option value="habis">Tampilkan</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="detail_produk">Detail / Deskripsi Produk</label>
                <textarea id="detail_produk" name="detail" rows="4" placeholder="Jelaskan spesifikasi atau deskripsi barang..." required></textarea>
            </div>
            
            <div class="form-group">
                <label for="foto_produk">Foto Produk</label>
                <input type="file" id="foto_produk" name="foto" accept="image/*" required>
                <small style="color: #666;">Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
            </div>
            
            <div class="modal-footer">
                <button type="button" id="btnBatal" class="btn-secondary">Batal</button>
                <button type="submit" name="submit_produk" class="btn-primary">Simpan Produk</button>
            </div>
            
        </form>
    </div>
</div>
    <script src="../js/inventaris.js"></script>
</body>
</html>