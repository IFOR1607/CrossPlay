// SEARCH BOX
const searchInput = document.getElementById('search-input');
const tabelProduk = document.getElementById('tabel-produk');

searchInput.addEventListener('input', ()=> {
    let keyword = searchInput.value;
    fetch('searchBox/cari-kategori.php?keyword=' + keyword)
        .then(response => response.text())
        .then(data => {
            tabelProduk.innerHTML = data;
        })
        .catch(error => {
            console.log('Terjadi kesalahan:', error);
        });
})  

// EDIT AND DELETE
// Kita pasang penjaga di induk tabel (tbody)
const ren = document.querySelector(".ren-modal-overlay");
const del = document.querySelector(".del-modal-overlay");

tabelProduk.addEventListener('click', (event) => {
    
    // 1. Browser mengecek target apa yang diklik oleh admin
    const tombolKlik = event.target.closest('.btn-cat-action'); 
    
    // Jika yang diklik bukan tombol Edit/Delete, abaikan saja
    if (!tombolKlik) return;        

    // 2. Jika benar tombol diklik, browser membaca "KTP/Atribut Data" dari tombol tersebut
    const idKategori   = tombolKlik.dataset.id;   // Mengambil nilai data-id
    const namaKategori = tombolKlik.dataset.nama; // Mengambil nilai data-nama

    // 3. Browser sekarang tahu persis kategori mana yang dipilih!
    if (tombolKlik.classList.contains('edit')) {
        ren.style.display = "flex";
        document.getElementById("namaKategori").value = namaKategori;
        document.getElementById("edit-id").value = idKategori;
        
        // Jalankan fungsi Rename untuk ID ini
        console.log("Kamu mau rename kategori ID: " + idKategori + " dengan nama: " + namaKategori);
    } 
    else if (tombolKlik.classList.contains('delete')) {
        del.style.display = "flex";
        document.getElementById("delete-kategori").value = idKategori;
        document.getElementById("nama-kategori-hapus").innerHTML = namaKategori;
        // Jalankan fungsi Delete untuk ID ini
        console.log("Kamu mau hapus kategori ID: " + idKategori);
    }
});


// CLOSE BTN
const tambahKategori = document.getElementById("btnTambahKategori");
const minimizeKategori = document.getElementById("closeModalKategori");
const modalKategori = document.getElementById("modalKategori");

tambahKategori.addEventListener('click',() => {
    modalKategori.style.display = 'flex'
} )

minimizeKategori.addEventListener('click', () => {
    modalKategori.style.display = 'none'
})
