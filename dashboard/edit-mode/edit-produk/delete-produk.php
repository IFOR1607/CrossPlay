<?php
    require_once dirname(__DIR__) . '../../../database/db.php'; 
// 1. Tangkap ID dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $ambilKolomFoto = $conn->query("SELECT * FROM produk WHERE id = '$id'");
    $keluarkanDataFoto = $ambilKolomFoto -> fetch_assoc();
    $pathFoto = '../../../img/produk/'.$keluarkanDataFoto['foto'];

    if(file_exists($pathFoto)) {
        unlink($pathFoto);
    }

    // 2. Jalankan Query Hapus Data
    $hapus = $conn->query("DELETE FROM produk WHERE id = '$id'");

    // 3. Kembalikan halaman ke tabel utama jika berhasil
    if ($hapus) {
        echo "<script>
                alert('Produk berhasil dihapus!');
                window.location.href = '../../inventaris.php'; // Sesuaikan nama file tabel utamamu
            </script>";
    } else {
        echo "Gagal menghapus data: " . $conn->error;
    }
} else {
    // Jika tidak ada ID di URL, lempar balik ke halaman utama
    header("Location: ../inventaris.php");
}
?>

