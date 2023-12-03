<?php
header("Content-Type: application/json");

// Include file koneksi
include 'koneksi.php';

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari body request
    $postData = file_get_contents("php://input");
    $data = json_decode($postData);

    // Pastikan data diterima dengan benar
    if ($data && isset($data->recipient_name) && isset($data->new_full_address)) {
        $recipientName = $data->recipient_name;
        $newFullAddress = $data->new_full_address;

        // Update data di database menggunakan nama sebagai acuan
        $stmt = $mysqli->prepare("UPDATE konsumen SET AlamatKonsumen = ? WHERE NKonsumen = ?");
        $stmt->bind_param("ss", $newFullAddress, $recipientName);

        if ($stmt->execute()) {
            $response = array("success" => true);
        } else {
            $response = array("success" => false);
        }

        $stmt->close();
    } else {
        // Data tidak lengkap
        $response = array("success" => false, "message" => "Data tidak lengkap");
    }
} else {
    // Metode request tidak diizinkan
    $response = array("success" => false, "message" => "Metode request tidak diizinkan");
}

// Menggunakan mysqli untuk koneksi database
if (isset($mysqli)) {
    // Tutup koneksi setelah selesai
    $mysqli->close();
}

// Mengembalikan respons
echo json_encode($response);
?>
