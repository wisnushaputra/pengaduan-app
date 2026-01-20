<?php
session_start();
include '../config/database.php';

// Cek Keamanan: Semua aksi di sini butuh admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    die("Akses ditolak!");
}

$act = $_GET['act'] ?? '';

// --- TAMBAH USER ---
if ($act == 'tambah') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $role     = $_POST['role'];

    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Username sudah ada!'); window.location='../users.php';</script>";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', '$role')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: ../users.php");
    }
}

// --- HAPUS USER ---
elseif ($act == 'hapus') {
    $id = $_GET['id'];
    
    if ($id == $_SESSION['user_id']) {
        echo "<script>alert('Tidak bisa hapus diri sendiri!'); window.location='../users.php';</script>";
        exit();
    }

    mysqli_query($conn, "DELETE FROM laporan WHERE user_id='$id'");
    mysqli_query($conn, "DELETE FROM users WHERE id='$id'");
    
    header("Location: ../users.php");
}
?>