<?php
    session_start();
    if($_SESSION['is_login'] == false) {
        header('location:../../../auth/login.php');
        exit(); 
    }

use Dom\Document;

    require_once dirname(__DIR__) . '../../../database/db.php'; 

$keluarkanData = '';
$pathFolder = '';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $dataSebelum = $conn -> query("SELECT   produk.id,
                                            produk.kategori_id,
                                            produk.nama AS nama_produk,
                                            produk.harga,
                                            produk.stok,
                                            produk.foto,
                                            produk.ketersediaan_stok,
                                            produk.detail,
                                            kategori.nama AS nama_kategori
                                            FROM produk INNER JOIN kategori ON produk.kategori_id = kategori.id WHERE produk.id ='$id' ");
    
    $keluarkanData = $dataSebelum -> fetch_assoc();
    $pathFolder = '../../../img/produk/'.$keluarkanData['foto'];


    if(isset($_POST['update_produk'])) {
        $namaProduk = $_POST['nama'];
        $hargaProduk = $_POST['harga'];
        $stokProduk = $_POST['stok'];
        $kategoriProduk = $_POST['kategori_id'];
        $deskripsiProduk = $_POST['deskripsi'];

        // foto
    $foto = $keluarkanData['foto']; 
    
    if($_FILES['fotoProdukInput']['error'] === 0) {

        $namafotoBaru = time(). '-' . $_FILES['fotoProdukInput']['name'];
        $tmp = $_FILES['fotoProdukInput']['tmp_name'];
        $folderTarget = '../../../img/produk/';

        if(move_uploaded_file($tmp, $folderTarget . $namafotoBaru)) {
            $jalurFotoLama = $folderTarget . $foto; 
            if(!empty($foto) && file_exists($jalurFotoLama)) {
                unlink($jalurFotoLama);
            }
            $foto = $namafotoBaru;
        }
    }


        $sqlUpdate = $conn -> query("UPDATE produk SET 
                                                        nama = '$namaProduk',
                                                        harga = '$hargaProduk',
                                                        stok = '$stokProduk',
                                                        foto = '$foto',
                                                        kategori_id = '$kategoriProduk',
                                                        detail = '$deskripsiProduk' WHERE
                                                        id ='$id'");
        if ($sqlUpdate) {
            header("Location:../../inventaris.php");
        } else {
            echo "Gagal mengupdate data: " . $conn->error;
        }
    }

}    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../../../css/edit-mode/edit-produk.css">
</head>
<body>

<div class="edit-container">
    <div class="edit-header">
        <a href="../../inventaris.php" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Tabel
        </a>
        <h1>Edit Produk</h1>
        <p>Perbarui informasi detail produk di bawah ini.</p>
    </div>

    <div class="edit-card">
        <form action="edit-produk.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
                
            <input type="hidden" name="id" value="12">
        
            <!-- NAMA -->
            <div class="form-group">
                <label for="nama">Nama Produk</label>
                <input type="text" id="nama" name="nama" value="<?= $keluarkanData['nama_produk']; ?>" required>
            </div>
            
            <div class="form-grid">
                
            <!-- HARGA -->
                <div class="form-group">
                    <label for="harga">Harga (Rp)</label>
                    <input type="number" id="harga" name="harga" value="<?= $keluarkanData['harga'];?>" required>
                </div>
                
            <!-- STOK -->
                <div class="form-group">
                    <label for="stok">Jumlah Stok</label>
                    <input type="number" id="stok" name="stok" value="<?= $keluarkanData['stok']; ?>" required>
                </div>
            </div>
        
            <div class="form-grid">
                
            <!-- KATEGORI -->
                <div class="form-group">
                    <label for="kategori_id">Kategori</label>
                    <select id="kategori_id" name="kategori_id" required>
                        <?php
                            $kategori = $conn -> query("SELECT * FROM kategori");
                            while($kat =$kategori -> fetch_assoc()) { 
                                $selected = ($kat['id'] == $keluarkanData['kategori_id']? 'selected':'');
                                echo "<option value='".$kat['id']."' $selected>".$kat['nama']."</option>";
                                }
                        ?>
                    </select>
                </div>
                <!-- VISIBILITAS -->
                <div class="form-group">
                    <label for="ketersediaan_stok">Visibilitas Produk</label>
                    <select id="ketersediaan_stok" name="ketersediaan_stok" required>
                        <option value="tersedia" selected>Sembunyikan</option>
                        <option value="habis">Tampilkan</option>
                    </select>
                </div>
            </div>

            <!-- DESKRIPSI -->
            <div class="form-group">
                <label for="detail">Detail / Deskripsi Produk</label>
                <textarea id="detail" name="deskripsi" rows="5" required><?= $keluarkanData['detail']; ?></textarea>
            </div>
            
            <!-- FOTO -->
            <div class="form-group file-section">
                <label>Foto Produk Saat Ini</label>
                <div class="current-image-preview">
                    <img src="<?= $pathFolder ?>" alt="Preview Foto">
                    <span class="file-info-text">Nama file: <?= $keluarkanData['foto']; ?></span>
                </div>
                
                <label for="foto" class="label-upload-baru">Ganti Foto Baru *(Kosongkan jika tidak ingin diubah)</label>
                <input type="file" id="foto" name="fotoProdukInput" accept="image/*">
            </div>

            <!-- SIMPAN DAN BATAL -->
            <div class="form-actions">
                <a href="../../inventaris.php" class="btn-cancel">Batal</a>
                <button type="submit" name="update_produk" class="btn-submit">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>

</body>
</html>
