<?php

function base_url($path = "") {
    
    return "/pengaduan-app/" . $path;
}

function redirect($path) {
    header("Location: " . base_url($path));
    exit;
}

function flash_alert($message, $path) {
    echo "<script>alert('$message'); window.location='" . base_url($path) . "';</script>";
    exit;
}

function upload_foto($file) {
    $target_dir = "../assets/uploads/";
    $file_name  = $file['name'];
    $file_tmp   = $file['tmp_name'];
    $file_ext   = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed    = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($file_ext, $allowed)) {
        $new_name = uniqid() . '.' . $file_ext;
        if (move_uploaded_file($file_tmp, $target_dir . $new_name)) {
            return $new_name;
        }
    }
    return null;
}
?>