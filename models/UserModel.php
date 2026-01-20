<?php
// FILE: models/UserModel.php

function get_user_by_username($conn, $username) {
    $username = mysqli_real_escape_string($conn, $username);
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    return mysqli_fetch_assoc($result);
}

function create_user($conn, $username, $password, $role) {
    $username = mysqli_real_escape_string($conn, $username);
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_pass', '$role')";
    return mysqli_query($conn, $sql);
}

function update_password($conn, $id, $new_password) {
    $hashed_pass = password_hash($new_password, PASSWORD_DEFAULT);
    return mysqli_query($conn, "UPDATE users SET password='$hashed_pass' WHERE id='$id'");
}

function delete_user($conn, $id) {
    // Hapus laporan dulu (Foreign Key)
    mysqli_query($conn, "DELETE FROM laporan WHERE user_id='$id'");
    // Baru hapus user
    return mysqli_query($conn, "DELETE FROM users WHERE id='$id'");
}
?>