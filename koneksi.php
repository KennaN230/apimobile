<?php
$host = "griya-srikandi.tifa.myhost.id";
$username = "tifamyho_srikandi";
$password = "@JTIpolije2023";
$database = "tifamyho_srikandi";

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
