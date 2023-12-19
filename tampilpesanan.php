<?php
// Sertakan file koneksi atau kodenya sesuai dengan kebutuhan
require_once 'koneksilokal.php';

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

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
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $row['NoPesanan'] . '</td>
                <td>' . $row['TglPemesanan'] . '</td>
                <td>' . $row['Bawal'] . '</td>
                <td>' . $row['TItem'] . '</td>
                <td>' . $row['TPembayaran'] . '</td>
            </tr>';
    }

    echo '</table>';
} else {
    echo 'Tidak ada data pesanan.';
}

// Menutup koneksi
$conn->close();
?>
