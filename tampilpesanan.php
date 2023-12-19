<?php
// Sertakan file koneksi atau kodenya sesuai dengan kebutuhan
require_once 'koneksilokal.php';

// Membuat koneksi ke database
$conn = new mysqli($host, $user, $password, $database);

// Menangani kesalahan koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil seluruh data dari tabel pemesanan
$sql = "SELECT * FROM pemesanan";

$result = $conn->query($sql);

// Menampilkan hasil query
if ($result->num_rows > 0) {
    echo '<h2>Daftar Pesanan</h2>';
    echo '<table border="1">
            <tr>
                <th>No Pesanan</th>
                <th>Tanggal Pemesanan</th>
                <th>Tipe Pembayaran</th>
                <th>Qty</th>
                <th>Total Harga</th>
            </tr>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $row['NoPesanan'] . '</td>
                <td>' . $row['TglPemesanan'] . '</td>
                <td>' . $row['TPembayaran'] . '</td>
                <td>' . $row['qty'] . '</td>
                <td>' . $row['harga'] * $row['qty'] . '</td>
            </tr>';
    }

    echo '</table>';
} else {
    echo 'Tidak ada data pesanan.';
}

// Menutup koneksi
$conn->close();
?>
