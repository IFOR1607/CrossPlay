<?php 
require_once dirname(__DIR__) . '/../database/db.php'; 
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        
$sql = "SELECT 
            k.id,
            k.nama,
            COUNT(p.id) AS total_prod
        FROM kategori k
        LEFT JOIN produk p ON k.id = p.kategori_id
        WHERE k.nama LIKE ?
        GROUP BY k.id";

        $stmt = $conn->prepare($sql);
        $searchParam = "%" . $keyword . "%";
        $stmt->bind_param("s", $searchParam);
        $stmt->execute();
        $result = $stmt->get_result();
        $no = 1;

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {?>
        <tr>
            <td> <strong><?= $no++ ?></strong></td>
            <td> <span  class="category-name"> <?= $row['nama'] ?></span></td>
            <td class="text-center"><span class="prod-count"><?= $row['total_prod'] ?></span></td>
            <td>
                <!-- Tombol -->
                <div class="cat-trigger-btns">
                    <a href="#" 
                    class="btn-cat-action edit" 
                    id="mantap"
                    data-id="<?= $row['id'] ?>" 
                    data-nama="<?= $row['nama'] ?>" 
                    title="Rename">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    
                    <a href="#" 
                    class="btn-cat-action delete" 
                    data-id="<?= $row['id'] ?>" 
                    data-nama="<?= $row['nama'] ?>" 
                    title="Hapus">
                        <i class="fa-solid fa-trash"></i>
                    </a>
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
<link rel="stylesheet" href="../css/manage-category.css">

