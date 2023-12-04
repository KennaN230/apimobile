<?php
require_once 'koneksi.php';

// Membuat koneksi di sini agar tetap terbuka selama operasi
$conn = new mysqli($host, $username, $password, $database);

// Menangani kesalahan koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data dari tabel (ganti 'nama_tabel' dengan nama tabel yang sesuai)
$sql = "SELECT NProduk, HJual, gambarproduk FROM produk";
$result = $conn->query($sql);

// Memeriksa apakah query berhasil dijalankan
if ($result === false) {
    die("Error: " . $conn->error);
}

// Memeriksa apakah ada data yang diambil
if ($result->num_rows > 0) {
    // Menyimpan data dalam array
    $data = array();

    while ($row = $result->fetch_assoc()) {
        // Mendapatkan path gambar
        $gambarPath = 'databarang.php' . $row['gambarproduk'];

        // Mengonversi gambar ke base64
        $base64Image = base64_encode(file_get_contents($gambarPath));

        // Menambahkan base64 ke setiap baris data
        $row['gambarproduk'] = $base64Image;

        $data[] = $row;
    }

    // Mengubah array menjadi format JSON dan menampilkannya
    echo json_encode($data);
} else {
    echo "Tidak ada data.";
}

// Menutup koneksi
$conn->close();
?>