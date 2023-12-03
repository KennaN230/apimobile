<?php
require_once 'koneksilokal.php'; // Sesuaikan dengan file koneksi database Anda

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST["NKonsumen"]);
    $password = mysqli_real_escape_string($conn, $_POST["Password"]);

    // Query untuk mengambil data pengguna berdasarkan username
    $query = "SELECT * FROM konsumen WHERE NKonsumen = '$username' AND Password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows === 1) {
        $response = array('success' => true, 'message' => 'Login berhasil');
    } else {
        $response = array('success' => false, 'message' => 'Login gagal');
    }
    echo json_encode($response);
}
?>
