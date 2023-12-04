<?php
require_once 'koneksi.php'; // Sesuaikan dengan file koneksi database Anda

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Membuat koneksi di sini agar tetap terbuka selama operasi
    $conn = new mysqli($host, $username, $password, $database);

    // Menangani kesalahan koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

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

    // Menutup koneksi setelah operasi selesai
    $conn->close();
}
?>
