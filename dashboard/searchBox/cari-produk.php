<?php
// Koneksi ke database
require_once dirname(__DIR__) . '/../database/db.php'; 

$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

$sql = "SELECT 
            produk.id,
            produk.nama AS nama_produk,
            produk.harga,   
            produk.stok,
            produk.ketersediaan_stok,
            kategori.nama AS kategori_produk
        FROM produk
        INNER JOIN kategori ON produk.kategori_id = kategori.id
        WHERE produk.nama LIKE ?";

$stmt = $conn->prepare($sql);
$searchParam = "%" . $keyword . "%";
$stmt->bind_param("s", $searchParam);
$stmt->execute();
$result = $stmt->get_result();
$no = 1;


if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        if ($row['stok'] == 0 || $row['ketersediaan_stok'] == 'habis') {
        $status = "habis";
        $classWarna = 'out';
        } elseif ($row['stok'] <= 50) {
            $status = "kritis";
            $classWarna = 'low';
            } else {
                $status = "tersedia";
                $classWarna = 'instock';
            }
?>
        <tr>
            <td> <?= $no++ ?></td>
            <td> <?= $row['nama_produk'] ?></td>
            <td><?= "Rp " . number_format($row['harga'], 0, ",", ".");
            ?></td>
            <td> <?= $row['kategori_produk'] ?></td>
            <td> <?= $row['stok'] ?></td>
            <td><span class="stock-badge <?php echo $classWarna ?>"><?= $status ?></span></td>
            <td>
                <div class="action-btns">
                    <a href="edit-mode/edit-produk/edit-produk.php?id=<?= $row['id'];?>" class="btn-action edit"><i class="fa-solid fa-pen"></i></a>
                    <a href="edit-mode/edit-produk/delete-produk.php?id=<?= $row['id']; ?>"class="btn-action delete"><i class="fa-solid fa-trash"></i></a>
                </div>
            </td> 
        </tr>
<?php
        } 
    } else {
                echo "<tr><td colspan='4' style='text-align:center;'>Barang tidak ditemukan</td></tr>";
            }
?>

<!-- LINK CSS -->
    <link rel="stylesheet" href="../css/inventaris.css">

