/**
 * FILE: assets/js/script.js
 * Deskripsi: Mengatur logika Frontend (Tabel, Filter, dan Statistik)
 */

// --- 1. STATE MANAGEMENT ---
let globalDataLaporan = [];


// --- 2. INITIALIZATION ---
document.addEventListener('DOMContentLoaded', () => {
    initApp();
});

function initApp() {
    fetchDataLaporan();

    // Event Listener Filter
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');

    if (searchInput) searchInput.addEventListener('keyup', handleFilter);
    if (statusFilter) statusFilter.addEventListener('change', handleFilter);
}


// --- 3. DATA FETCHING ---
async function fetchDataLaporan() {
    const tableBody = document.getElementById('tabel-laporan');
    
    try {
        const response = await fetch('api/get_laporan.php');
        if (!response.ok) throw new Error("Gagal koneksi API");

        const data = await response.json();
        globalDataLaporan = data;

        // A. Render Tabel Data
        renderTable(globalDataLaporan);
        
        // B. Update Statistik (Fungsi Baru Dipanggil Disini)
        calculateStats(globalDataLaporan);

    } catch (error) {
        console.error('Error:', error);
        if(tableBody) tableBody.innerHTML = `<tr><td colspan="6" class="text-center text-danger">Gagal memuat data.</td></tr>`;
    }
}


// --- 4. STATISTIC LOGIC (FUNGSI BARU) ---
function calculateStats(data) {
    // Cek apakah elemen statistik ada di halaman ini (Mencegah error di halaman lain)
    const elTotal = document.getElementById('stat-total');
    if (!elTotal) return; // Stop jika tidak ada elemen

    // Hitung Jumlah Data menggunakan filter Array
    const total   = data.length;
    const pending = data.filter(item => item.status === 'pending').length;
    const proses  = data.filter(item => item.status === 'proses').length;
    const selesai = data.filter(item => item.status === 'selesai').length;

    // Masukkan angka ke HTML
    // Gunakan animasi sederhana (innerText update)
    document.getElementById('stat-total').innerText   = total;
    document.getElementById('stat-pending').innerText = pending;
    document.getElementById('stat-proses').innerText  = proses;
    document.getElementById('stat-selesai').innerText = selesai;
}


// --- 5. FILTERING LOGIC ---
function handleFilter() {
    const keyword = document.getElementById('searchInput').value.toLowerCase();
    const status  = document.getElementById('statusFilter').value;

    const filteredData = globalDataLaporan.filter(item => {
        const matchStatus = (status === '') || (item.status === status);
        const textContent = `${item.username} ${item.isi_laporan}`.toLowerCase();
        const matchKeyword = textContent.includes(keyword);

        return matchStatus && matchKeyword;
    });

    renderTable(filteredData);
    // Catatan: Kita tidak update statistik saat filter, agar angka tetap menunjukkan total keseluruhan.
}


// --- 6. RENDERING LOGIC ---
function renderTable(data) {
    const tableBody = document.getElementById('tabel-laporan');
    if (!tableBody) return;

    let tableContent = '';

    if (data.length === 0) {
        const colSpan = isAdmin() ? 6 : 5;
        tableBody.innerHTML = `<tr><td colspan="${colSpan}" class="text-center py-4 text-muted">Data tidak ditemukan.</td></tr>`;
        return;
    }

    data.forEach(item => {
        tableContent += createRowHtml(item);
    });

    tableBody.innerHTML = tableContent;
}


// --- 7. HTML GENERATORS ---
function createRowHtml(item) {
    return `
        <tr>
            <td class="text-center align-middle small">${item.tanggal}</td>
            <td class="align-middle fw-semibold">${item.username}</td>
            <td class="align-middle">${item.isi_laporan}</td>
            <td class="text-center align-middle">${generatePhotoHtml(item.foto)}</td>
            <td class="text-center align-middle">${generateStatusBadge(item.status)}</td>
            ${isAdmin() ? generateAdminAction(item) : ''}
        </tr>
    `;
}

function generatePhotoHtml(fotoName) {
    if (!fotoName) return '<span class="text-muted small fst-italic">Tidak ada</span>';
    return `
        <a href="assets/uploads/${fotoName}" target="_blank" title="Lihat ukuran penuh">
            <img src="assets/uploads/${fotoName}" class="shadow-sm" 
                 style="width: 80px; height: 60px; object-fit: cover; border-radius: 6px;">
        </a>`;
}

function generateStatusBadge(status) {
    let colorClass = 'bg-secondary';
    if (status === 'selesai') colorClass = 'bg-success';
    else if (status === 'proses') colorClass = 'bg-warning text-dark';
    else if (status === 'pending') colorClass = 'bg-danger';

    return `<span class="badge ${colorClass} badge-status px-3 py-2 text-uppercase" style="font-size: 0.75rem;">${status}</span>`;
}

function generateAdminAction(item) {
    return `
    <td class="text-center align-middle">
        <form action="actions/laporan.php?act=update" method="POST" class="d-flex justify-content-center gap-1">
            <input type="hidden" name="id_laporan" value="${item.id}">
            <select name="status" class="form-select form-select-sm" style="width:auto; cursor:pointer;">
                <option value="pending" ${item.status === 'pending' ? 'selected' : ''}>Pending</option>
                <option value="proses" ${item.status === 'proses' ? 'selected' : ''}>Proses</option>
                <option value="selesai" ${item.status === 'selesai' ? 'selected' : ''}>Selesai</option>
            </select>
            <button type="submit" class="btn btn-sm btn-primary">Update</button>
        </form>
    </td>`;
}


// --- 8. UTILITIES ---
function isAdmin() {
    return (typeof globalUserRole !== 'undefined' && globalUserRole === 'admin');
}