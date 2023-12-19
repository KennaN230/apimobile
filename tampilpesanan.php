<?php
// Sertakan file koneksi atau kodenya sesuai dengan kebutuhan
require_once 'koneksi.php';

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
    echo '<html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <style>
                    table {
                        font-family: Arial, sans-serif;
                        border-collapse: collapse;
                        width: 100%;
                        margin-top: 20px;
                    }
                    th, td {
                        border: 1px solid #dddddd;
                        text-align: left;
                        padding: 8px;
                    }
                    th {
                        background-color: #f2f2f2;
                    }
                </style>
            </head>
            <body>';

    echo '<h2>Daftar Pesanan</h2>';
    echo '<table>';
    echo '<tr>
            <th>No Pesanan</th>
            <th>Tanggal Pemesanan</th>
            <th>Bawal</th>
            <th>Total Item</th>
            <th>Tipe Pembayaran</th>
        </tr>';

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
    echo '</body></html>';
} else {
    echo 'Tidak ada data pesanan.';
}

// Menutup koneksi
$conn->close();
?>
