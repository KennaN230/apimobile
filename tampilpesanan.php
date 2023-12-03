<?php
// Sertakan file koneksi atau kodenya sesuai dengan kebutuhan
require_once 'koneksilokal.php';

// Ambil username dari sesi atau cara lainnya sesuai dengan aplikasi Anda
$username = "Select NKonsumen"; // Ganti dengan cara Anda mendapatkan username

// Query untuk mengambil pesanan berdasarkan username
$sql = "SELECT id_pesanan, nama_produk, harga, qty, harga * qty AS total_harga
        FROM detail pesanan
        WHERE username = '$username'  from konsumen";

$result = $conn->query($sql);

// Menampilkan hasil query
if ($result->num_rows > 0) {
    echo '<h2>Daftar Pesanan untuk ' . $username . '</h2>';
    echo '<table border="1">
            <tr>
                <th>ID Pesanan</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Total Harga</th>
            </tr>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $row['id_pesanan'] . '</td>
                <td>' . $row['nama_produk'] . '</td>
                <td>' . $row['harga'] . '</td>
                <td>' . $row['qty'] . '</td>
                <td>' . $row['total_harga'] . '</td>
            </tr>';
    }

    echo '</table>';
} else {
    echo 'Tidak ada pesanan untuk ' . $username;
}

// Menutup koneksi
$conn->close();
?>
