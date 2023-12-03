<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'koneksi.php'; // Sertakan file koneksi.php

    // Mendapatkan data dari permintaan POST
    $username = $_POST['NKonsumen'];
    $newPassword = $_POST['Password'];

    // Validasi data (Anda dapat menambahkan validasi tambahan sesuai kebutuhan)
    if (empty($username) || empty($newPassword)) {
        $response = array('status' => 'error', 'message' => 'Memerlukan Username dan Password');
    } else {
        // Update password di database tanpa hash
        $updatePasswordQuery = "UPDATE konsumen SET Password = '$newPassword' WHERE NKonsumen = '$username'";
        $updateResult = $conn->query($updatePasswordQuery);

        if ($updateResult) {
            $response = array('status' => 'success', 'message' => 'Berhasil Mengubah Password');
        } else {
            $response = array('status' => 'error', 'message' => 'Gagal Mengubah Password: ' . $conn->error);
        }
    }
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request method');
}

// Mengembalikan respons dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);

// Tutup koneksi database
$conn->close();
?>
