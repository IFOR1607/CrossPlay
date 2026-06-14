const modalProduk = document.getElementById('modalProduk');
const btnTambahBarang = document.getElementById('tambahBarang');

btnTambahBarang.addEventListener("click",()=> {
    modalProduk.style.display = 'flex';
});

const minimizeModal = document.getElementById('minimize');
minimizeModal.addEventListener("click",() => {
    modalProduk.style.display = 'none';
});

const btnBatal = document.getElementById('btnBatal');

btnBatal.addEventListener("click", () => {
    modalProduk.style.display = 'none';

})


// FITUR SEARCH
const searchInput = document.getElementById('search-input');
const tableProduk = document.getElementById('table-produk');

searchInput.addEventListener('input', () => {
    let keyword = searchInput.value;

    fetch('searchBox/cari-produk.php?keyword=' + keyword)
        .then(response => response.text())
        .then(data => {
            tableProduk.innerHTML = data;
        })
        .catch(error => {
            console.log('terjadi kesalahan:', error)
        })
})