<?php
header('Content-Type: application/json');
include '../config/database.php';
include '../models/LaporanModel.php'; // Pakai Model

$result = get_all_laporan($conn);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
echo json_encode($data);
?>