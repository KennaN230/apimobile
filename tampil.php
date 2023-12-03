<?php
// Sertakan file koneksi
require_once 'koneksi.php';

// Membuat koneksi di sini agar tetap terbuka selama operasi
$conn = new mysqli($host, $username, $password, $database);

// Menangani kesalahan koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data dari tabel (ganti 'nama_tabel' dengan nama tabel yang sesuai)
$sql = "SELECT NProduk, HJual FROM produk";
$result = $conn->query($sql);

// Memeriksa apakah query berhasil dijalankan
if ($result === false) {
    die("Error: " . $conn->error);
}

// Memeriksa apakah ada data yang diambil
if ($result->num_rows > 0) {
    // Menampilkan data
    echo "<table border='1'>
            <tr>
                <th>Nama</th>
                <th>Harga</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["NProduk"] . "</td>
                <td>" . $row["HJual"] . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "Tidak ada data.";
}

// Menutup koneksi
$conn->close();
?>
