# 📝 Catatan Fitur Kode (PHP & JavaScript CRUD)

---

1. Convert Angka ke Rupiah
Mengubah format angka mentah menjadi format mata uang Rupiah.
```php
<td><?= "Rp " . number_format($dataProduk['harga'], 0, ",", ".");?></td>



2. INNER JOIN
$keluarkanDataProduk = $conn->query("
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


3. Cara masukin foto ke database sekaligus ke folder
$nama_foto = $_FILES['foto']['name'];
$lokasi_foto = $_FILES['foto']['tmp_name'];
$lokasi_tujuan = "../img/produk/" . $nama_foto;

// Note: Pastikan jumlah kolom dan value yang di-insert sudah sesuai
$sql = $conn->query("INSERT INTO produk (kategori_id, nama, harga, stok, foto, detail) VALUES ('$nama_foto')");

if($sql) {
    move_uploaded_file($lokasi_foto, $lokasi_tujuan);
    $messege_error = 'data berhasil masuk';
}   


4. Cara hapus foto dari folder
$ambilKolomFoto = $conn->query("SELECT * FROM produk WHERE id = '$id'");
$keluarkanDataFoto = $ambilKolomFoto->fetch_assoc();
$pathFoto = '../../img/produk/' . $keluarkanDataFoto['foto'];

if(file_exists($pathFoto)) {
    unlink($pathFoto);
}

5. membuat id terlihat dan produk terselect sesuai id 
<a href="edit-mode/edit-produk.php?id=<?= $dataProduk['id'];?>" class="btn-action edit">
    <i class="fa-solid fa-pen"></i>
</a>


6. Cara loop fitur option dropdown
<select id="kategori_id" name="kategori_id" required>
<?php
    $kategori = $conn->query("SELECT * FROM kategori");
    
    while($kat = $kategori->fetch_assoc()) { 
        echo "<option value='".$kat['id']."'>".$kat['nama']."</option>";
    }
?>
</select>


7. Cara agar option dropDown sama seperti data sebelumnya pada form edit
<select name="kategoriProduk" id="kategori_produk" required>
    <?php
    $ambilKategori = $conn->query("SELECT * FROM kategori");
    
    while ($kat = $ambilKategori->fetch_assoc()) {
        $selected = ($kat['id'] == $produk['kategori_id']) ? 'selected' : '';
        echo "<option value='".$kat['id']."' $selected>".$kat['nama']."</option>";
    }       
    ?>
</select>

8. Cara update foto
$foto = $produk['foto']; 

if($_FILES['fotoProduk']['error'] === 0) {
    $namafotoBaru = time() . '-' . $_FILES['fotoProduk']['name'];
    $tmp = $_FILES['fotoProduk']['tmp_name'];
    $folderTarget = '../assets/images/admin/product/';

    if(move_uploaded_file($tmp, $folderTarget . $namafotoBaru)) {
        $jalurFotoLama = $folderTarget . $foto; 
        if(!empty($foto) && file_exists($jalurFotoLama)) {
            unlink($jalurFotoLama);
        }
        $foto = $namafotoBaru;
    }
}

9. Cara mengedit/UPDATE tanpa membuat page baru
<a href="manage-category.php?action=edit&id=<?= $dataKategori['id'] ?>" class="btn-cat-action edit" title="Rename">
    <i class="fa-solid fa-pen-to-square"></i>
</a>


10. Cara menangkap id di page yang sama
if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    // Ambil $_GET['id'] dan jalankan query select data di sini
}


11. Cara membuat fitur searchBox produk di tabel

	- kita berikan ID di inputan dan tbody
    
        <input type="text" id="search-input" placeholder="Cari nama atau kode barang...">
        <tbody id="table-produk"> </tbody>

	- panggil ke js dan berikan kode ini
        const searchInput = document.getElementById('search-input');
        const tableProduk = document.getElementById('table-produk');

        searchInput.addEventListener('input', () => {
            let keyword = searchInput.value;

            fetch('cari-produk.php?keyword=' + keyword)
                .then(response => response.text())
                .then(data => {
                    tableProduk.innerHTML = data;
                })
                .catch(error => {
                    console.log('Terjadi kesalahan:', error);
                });
        });
    
	-dan buat file php 
        require_once dirname(__DIR__) . '/database/db.php'; 
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

        $sql = "SELECT * FROM produk WHERE nama LIKE ?";
        $stmt = $conn->prepare($sql);
        $searchParam = "%" . $keyword . "%";
        $stmt->bind_param("s", $searchParam);
        $stmt->execute();
        $result = $stmt->get_result();
        $no = 1;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {?>
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
                            // Jika tidak ada barang yang cocok
                            echo "<tr><td colspan='4' style='text-align:center;'>Barang tidak ditemukan</td></tr>";
                        }

?>

12. Cara membuat fitur status produk

    -Buat  css
        /* Badge untuk Indikator Stok */
        .stock-badge {
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 600;
        }

        .stock-badge.instock {
            background-color: #d4edda;
            color: #155724;
        }

        .stock-badge.low {
            background-color: #fff3cd;
            color: #856404;
        }

        .stock-badge.out {
            background-color: #f8d7da;
            color: #721c24;
        }

    - Buat perkondisian
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

    - Tampilkan
        <td><span class="stock-badge <?php echo $classWarna ?>"><?= $status ?></span></td>

    - Another one
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

13. Cara agar js punya isi database 
    <!-- Tombol -->
    <div class="cat-trigger-btns">
        <a href="#" 
        class="btn-cat-action edit" 
        // bagian ini start >
        data-id="<?= $row['id'] ?>" 
        data-nama="<?= $row['nama'] ?>" 
        // bagian ini  end >
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


14. Cara membuat fitur search box lengkap dengan menggunakan metode event delegation
    
# =============================================================================
# -🛠️ LANGKAH 1: Struktur Halaman Utama
# =============================================================================

            <div class="search-box">
        <i class="fa-solid fa-magnifying-glass"></i>
        // input
        <input type="text" id="search-input" placeholder="Cari nama kategori...">
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Total Produk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        // Buat ID >
        <tbody id="tabel-kategori">
        </tbody>
    </table>

    <div class="ren-modal-overlay" style="display: none;">
        <button class="btn-batal">Batal</button>
    </div>

    <div class="del-modal-overlay" style="display: none;">
        <button class="btn-batal">Batal</button>
    </div>

# =============================================================================
# - LANGKAH 2: membuat fungsi fetch API untuk mengirim dan menerima ID.
# =============================================================================   
    
        // AMBIL SEMUA ELEMEN YANG DIBUTUHKAN
        const searchInput  = document.getElementById("search-input");
        const tabelKategori = document.getElementById("tabel-kategori");
        const renModal     = document.querySelector(".ren-modal-overlay");
        const delModal     = document.querySelector(".del-modal-overlay");

        // =======================================================
        // A. FITUR LIVE SEARCH (FETCH API)
        // =======================================================
        searchInput.addEventListener("input", function() {
            let keyword = searchInput.value;

            // Tembak data ke backend di latar belakang tanpa reload halaman
            fetch('cari-kategori.php?keyword=' + keyword)
                .then(response => response.text()) // Ubah respon kiriman PHP menjadi teks HTML
                .then(data => {
                    tabelKategori.innerHTML = data; // Ganti isi tabel lama dengan hasil pencarian baru
                })
                .catch(error => console.error("Gagal memuat data:", error));
        });

        // =======================================================
        // B. EVENT DELEGATION (UNTUK TOMBOL EDIT & DELETE DINAMIS)
        // =======================================================
        tabelKategori.addEventListener('click', function(event) {
            const tombolKlik = event.target.closest('.btn-cat-action');
            if (!tombolKlik) return; // Jika bukan tombol aksi, abaikan kliknya

            const idKategori   = tombolKlik.dataset.id;   
            const namaKategori = tombolKlik.dataset.nama; 

            if (tombolKlik.classList.contains('edit')) {
                renModal.style.display = "flex";
                console.log("Membuka Edit ID: " + idKategori);
            } 
            // Jika yang diklik adalah tombol delete
            else if (tombolKlik.classList.contains('delete')) {
                delModal.style.display = "flex";
                console.log("Membuka Delete ID: " + idKategori);
            }
        });

        // =======================================================
        // C. MENUTUP MODAL TANPA REFRESH HALAMAN (preventDefault)
        // =======================================================
        // Menutup Modal Rename
        renModal.addEventListener('click', function(event) {
            const tombolBatal = event.target.closest('.btn-batal');
            if (tombolBatal) {
                event.preventDefault(); // Kunci halaman agar tidak refresh/pindah URL
                renModal.style.display = "none";
            }
        });

        // Menutup Modal Delete
        delModal.addEventListener('click', function(event) {
            const tombolBatal = event.target.closest('.btn-batal');
            if (tombolBatal) {
                event.preventDefault(); // Kunci halaman agar tidak refresh/pindah URL
                delModal.style.display = "none";
            }
        });
# =============================================================================
# - LANGKAH 3: Buat file PHP terpisah khusus untuk melayani pencarian.
# ============================================================================= 
         .

        <?php 
    // 1. Hubungkan Koneksi Database
    require_once dirname(__DIR__) . '/../database/db.php'; 

    // 2. Tangkap kata kunci dari Fetch API (Jika kosong, set teks kosong)
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

    // 3. Susun SQL Query (Menggunakan INNER/LEFT JOIN & klausa WHERE LIKE)
    $sql = "SELECT 
                k.id,
                k.nama,
                COUNT(p.id) AS total_prod
            FROM kategori k
            LEFT JOIN produk p ON k.id = p.kategori_id
            WHERE k.nama LIKE ?
            GROUP BY k.id";

    // 4. Jalankan Prepared Statement (Demi Keamanan dari Hacker / SQL Injection)
    $stmt = $conn->prepare($sql);
    $searchParam = "%" . $keyword . "%"; // % berarti mencari kata di posisi mana saja
    $stmt->bind_param("s", $searchParam); // "s" berarti tipe data parameter adalah String
    $stmt->execute();
    $result = $stmt->get_result();

    $no = 1;

    // 5. Cek apakah data ditemukan, lalu cetak hasilnya
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><strong><?= $no++ ?></strong></td>
                <td><span class="category-name"><?= $row['nama'] ?></span></td>
                <td class="text-center"><span class="prod-count"><?= $row['total_prod'] ?></span></td>
                <td>
                    <div class="cat-trigger-btns">
                        <a href="#" class="btn-cat-action edit" data-id="<?= $row['id'] ?>" data-nama="<?= $row['nama'] ?>">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="#" class="btn-cat-action delete" data-id="<?= $row['id'] ?>" data-nama="<?= $row['nama'] ?>">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>   
        <?php
        } 
    } else {
        // Jika data tidak ada yang cocok di database
        echo "<tr><td colspan='4' style='text-align:center;'>Kategori tidak ditemukan</td></tr>";
    }
    ?>

15. SQL update
$sqlUpdate = $conn -> query("UPDATE produk SET 
                                            nama = '$namaProduk',
                                            harga = '$hargaProduk',
                                            stok = '$stokProduk',
                                            foto = '$foto',
                                            kategori_id = '$kategoriProduk',
                                            detail = '$deskripsiProduk' WHERE
                                            id ='$id'");


16. Cara menggunakan metode Prepare security
    - bentuk contoh
    $sql = "UPDATE kategori SET nama = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nama, $id); // "s" untuk string (nama), "i" untuk integer (id)
    
        - EXAMPLE = FITUR RENAME
            if(isset($_POST['simpan_perubahan'])) {
                $namaKategori = $_POST['nama_kategori'];
                $idKategori= $_POST['id_kategori'];

                $sqlUpdate = "UPDATE kategori SET  nama = ? WHERE id = ? ";
                $stmt = $conn -> prepare($sqlUpdate);
                $stmt->bind_param("si",$namaKategori ,$idKategori);

                if($stmt->execute()) {
                }
        }

        - EXAMPLE = FITUR TAMBAH
            if(isset($_POST['tambahKategori'])) {
                $inputKatgori = $_POST['inputKategori'];
                
                $sqlKategori = "INSERT INTO kategori (nama) VALUE (?)";
                $stmt = $conn -> prepare($sqlKategori);
                $stmt -> bind_param('s',$inputKatgori);
                $stmt -> execute();
        }

        - EXAMPLE = FITUR DELETE
            if(isset($_POST['konfirmasi_hapus'])) {
                $delete_Kategori = $_POST['deleteKategori'];

                $sqlHapus = "DELETE FROM kategori WHERE id = ? ";
                $stmt = $conn -> prepare($sqlHapus);
                $stmt-> bind_param('i',$delete_Kategori);
                $stmt->execute();

                if($stmt->execute()) {
                }
            }


        

17. Cara menggunakan try catch error
try {
    // 1. KODE CRUD KAMU YANG MAU DIUJI
    $sqlHapus = "DELETE FROM kategori WHERE id = ?";
    $stmt = $conn->prepare($sqlHapus);
    $stmt->bind_param('i', $delete_Kategori);
    $stmt->execute();
    
    $messege_error = 'Data berhasil dihapus';
    $stmt->close();

} catch (mysqli_sql_exception $error) {
    // 2. TANGKAP ERROR KHUSUS DATABASE DI SINI
    // Catat ke log file server internal (opsional tapi profesional)
    error_log($error->getMessage()); 
    
    // Set pesan error untuk ditampilkan di sistem kamu
    $messege_error = 'Gagal menghapus data dari database! ' . $error->getMessage();
    
} catch (Exception $error) {
    // 3. TANGKAP ERROR UMUM LAINNYA (Jika ada error PHP biasa)
    $messege_error = 'Terjadi kesalahan sistem: ' . $error->getMessage();
}