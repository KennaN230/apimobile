<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "grriya";

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Menangani kesalahan koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Kode SQL atau operasi lain dapat ditambahkan di sini

// Menutup koneksi
$conn->close();
?>
