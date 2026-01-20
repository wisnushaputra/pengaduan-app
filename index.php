<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    
    <?php include 'includes/navbar.php'; ?>

    <div class="container mt-4">
        
        <?php if ($_SESSION['role'] == 'masyarakat') : ?>
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Buat Pengaduan Baru</div>
            <div class="card-body">
                <form action="actions/laporan.php?act=tambah" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <textarea name="isi_laporan" class="form-control" rows="3" placeholder="Tulis keluhan Anda secara detail..." required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Bukti Foto (Opsional)</label>
                        <input type="file" name="bukti_foto" class="form-control" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG. Maksimal ukuran wajar.</small>
                    </div>

                    <button type="submit" class="btn btn-success px-4">Kirim Laporan</button>
                </form>
            </div>
        </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header bg-secondary text-white">Daftar Laporan Masuk</div>
            <div class="card-body">  
                <div class="row mb-3 g-2">
                    <div class="col-md-6">
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari nama atau isi laporan...">
                    </div>

                    <div class="col-md-6 d-flex gap-2">
                        <select id="statusFilter" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="pending">Pending</option>
                            <option value="proses">Proses</option>
                            <option value="selesai">Selesai</option>
                        </select>

                        <?php if ($_SESSION['role'] == 'admin') : ?>
                            <a href="cetak.php" target="_blank" class="btn btn-dark d-flex align-items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                    <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                                </svg>
                                Cetak
                            </a>
                        <?php endif; ?>
                    </div>
                </div>


                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card card-stats bg-primary text-white shadow-sm mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-subtitle mb-2 opacity-75">Total Laporan</h6>
                                        <h2 class="card-title fw-bold mb-0" id="stat-total">0</h2>
                                    </div>
                                    <div class="fs-1 opacity-25">📝</div> </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card card-stats bg-danger text-white shadow-sm mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-subtitle mb-2 opacity-75">Pending</h6>
                                        <h2 class="card-title fw-bold mb-0" id="stat-pending">0</h2>
                                    </div>
                                    <div class="fs-1 opacity-25">⏳</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card card-stats bg-warning text-dark shadow-sm mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-subtitle mb-2 opacity-75">Proses</h6>
                                        <h2 class="card-title fw-bold mb-0" id="stat-proses">0</h2>
                                    </div>
                                    <div class="fs-1 opacity-25">⚙️</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card card-stats bg-success text-white shadow-sm mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-subtitle mb-2 opacity-75">Selesai</h6>
                                        <h2 class="card-title fw-bold mb-0" id="stat-selesai">0</h2>
                                    </div>
                                    <div class="fs-1 opacity-25">✅</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th width="15%">Tanggal</th>
                            <th width="15%">Pelapor</th>
                            <th>Isi Laporan</th>
                            <th width="15%">Bukti</th> <th width="10%">Status</th>
                            <?php if ($_SESSION['role'] == 'admin') echo "<th width='20%'>Aksi Admin</th>"; ?>
                        </tr>
                    </thead>
                    <tbody id="tabel-laporan">
                        <tr><td colspan="5" class="text-center py-4">Sedang memuat data...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Kita "oper" variabel PHP ke variabel JavaScript Global
        // agar bisa dibaca oleh file assets/js/script.js
        const globalUserRole = "<?= $_SESSION['role'] ?>";
    </script>
    
    <script src="assets/js/script.js"></script>

</body>
</html>