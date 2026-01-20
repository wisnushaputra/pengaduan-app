<?php
session_start();
include '../config/database.php';
include '../helpers/functions.php';  // Panggil Helper
include '../models/LaporanModel.php'; // Panggil Model

if (!isset($_SESSION['user_id'])) { redirect('login.php'); }

$act = $_GET['act'] ?? '';

// --- TAMBAH LAPORAN ---
if ($act == 'tambah') {
    $foto = null;
    if (isset($_FILES['bukti_foto']) && $_FILES['bukti_foto']['error'] == 0) {
        $foto = upload_foto($_FILES['bukti_foto']); // Pakai fungsi helper
        if (!$foto) flash_alert("Gagal upload atau format salah!", "index.php");
    }
    
    // Panggil Model
    if (create_laporan($conn, $_SESSION['user_id'], $_POST['isi_laporan'], $foto)) {
        redirect('index.php');
    } else {
        flash_alert("Gagal menyimpan data.", "index.php");
    }
}

// --- UPDATE STATUS ---
elseif ($act == 'update') {
    if ($_SESSION['role'] != 'admin') die("Akses ditolak");
    
    update_status_laporan($conn, $_POST['id_laporan'], $_POST['status']);
    redirect('index.php');
}
?>