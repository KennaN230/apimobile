<?php
header("Content-Type: application/json");

include 'koneksi.php';

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari body request
    $postData = file_get_contents("php://input");
    $data = json_decode($postData);

    // Pastikan data diterima dengan benar
    if ($data && isset($data->old_recipient_name) && isset($data->recipient_phone) && isset($data->full_address)) {
        $oldRecipientName = $data->old_recipient_name;
        $recipientPhone = $data->recipient_phone;
        $fullAddress = $data->full_address;

        // Perbarui data di database berdasarkan nama penerima
        $query = "UPDATE konsumen SET NoTelp = '$recipientPhone', Email = '$fullAddress' WHERE NKonsumen = '$oldRecipientName'";
        $result = $koneksi->query($query);

        if ($result) {
            $response = array("success" => true);
        } else {
            $response = array("success" => false);
        }

        echo json_encode($response);
    } else {
        // Data tidak lengkap
        echo json_encode(array("success" => false, "message" => "Data tidak lengkap"));
    }
} else {
    // Metode request tidak diizinkan
    echo json_encode(array("success" => false, "message" => "Metode request tidak diizinkan"));
}
?>
