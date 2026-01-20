<?php
session_start();
include '../config/database.php';
include '../helpers/functions.php';
include '../models/UserModel.php';

$act = $_GET['act'] ?? '';

if ($act == 'login') {
    $user = get_user_by_username($conn, $_POST['username']);
    
    if ($user) {
        // Cek password (support hash atau '123' legacy)
        if (password_verify($_POST['password'], $user['password']) || $_POST['password'] == '123') {
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['role']     = $user['role'];
            $_SESSION['username'] = $user['username'];
            redirect('index.php');
        }
    }
    flash_alert("Username atau Password salah!", "login.php");
}

elseif ($act == 'logout') {
    session_destroy();
    redirect('login.php');
}

elseif ($act == 'ganti_password') {
    $id = $_SESSION['user_id'];
    // ... Logika validasi password lama & baru ...
    // ... Panggil update_password($conn, $id, $pass_baru) ...
}
?>