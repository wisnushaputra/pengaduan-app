<?php
session_start();
include 'config/database.php';

// Cek akses admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    die("Anda tidak memiliki akses untuk mencetak laporan.");
}

$query = "SELECT laporan.*, users.username 
          FROM laporan 
          JOIN users ON laporan.user_id = users.id 
          ORDER BY laporan.tanggal DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Cetak Laporan Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="assets/css/print.css" rel="stylesheet">
</head>

<body onload="window.print()">

    <div class="container mt-4">
        
        <div class="header-laporan">
            <h2>PEMERINTAH KOTA BANDUNG</h2>
            <h3>DINAS PENGADUAN MASYARAKAT</h3>
            <p>Jl. Jendral Sudirman No. 123, Kota Bandung - Telp. (021) 123456</p>
        </div>

        <h4 class="text-center mb-4 text-uppercase fw-bold">Laporan Pengaduan</h4>

        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th width="5%">No</th>
                    <th width="15%">Tanggal</th>
                    <th width="20%">Pelapor</th>
                    <th>Isi Laporan</th>
                    <th width="10%">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) : 
                        
                        $status_label = strtoupper($row['status']); 
                ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="text-center"><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                        <td><?= htmlspecialchars($row['username']) ?></td>
                        <td><?= htmlspecialchars($row['isi_laporan']) ?></td>
                        <td class="text-center fw-bold"><?= $status_label ?></td>
                    </tr>
                <?php 
                    endwhile; 
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Tidak ada data laporan.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="tanda-tangan">
            <p>Kota Bandung, <?= date('d F Y') ?></p>
            <p>Kepala Dinas,</p>
            <br><br><br>
            <p class="fw-bold text-decoration-underline">Budi Santoso, S.Kom</p>
            <p>NIP. 19850101 201001 1 001</p>
        </div>

    </div>

</body>
</html>