<?php
require_once('koneksi.php');

// Waktu saat ini
$current_time = date("Y-m-d H:i:s");

// Query untuk mendapatkan data flash sale
$sql = "SELECT * FROM flash_sale WHERE start_time <= '$current_time' AND end_time >= '$current_time'";
$result = $conn->query($sql);

$data = array();

// Ambil hasil query
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Tutup koneksi
$conn->close();

// Keluarkan data dalam format JSON
echo json_encode($data);
?>
