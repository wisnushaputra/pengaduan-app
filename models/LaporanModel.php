<?php
// FILE: models/LaporanModel.php

function get_all_laporan($conn) {
    $query = "SELECT laporan.*, users.username 
              FROM laporan 
              JOIN users ON laporan.user_id = users.id 
              ORDER BY laporan.tanggal DESC";
    return mysqli_query($conn, $query);
}

function create_laporan($conn, $user_id, $isi, $foto) {
    $isi = mysqli_real_escape_string($conn, $isi);
    $sql = "INSERT INTO laporan (user_id, isi_laporan, foto) VALUES ('$user_id', '$isi', '$foto')";
    return mysqli_query($conn, $sql);
}

function update_status_laporan($conn, $id, $status) {
    $sql = "UPDATE laporan SET status='$status' WHERE id='$id'";
    return mysqli_query($conn, $sql);
}
?>