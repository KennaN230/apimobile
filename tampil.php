<?php
// Sertakan file koneksi
include 'koneksi.php';

// Periksa apakah ada data yang dikirimkan melalui POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Query untuk mengambil data dari tabel (ganti 'nama_tabel' dengan nama tabel yang sesuai)
    $sql = "SELECT NProduk, HJual, gambarproduk FROM produk";
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
                    <th>Gambar</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["nama"] . "</td>
                    <td>" . $row["harga"] . "</td>
                    <td><img src='" . $row["gambar"] . "' alt='Gambar'></td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "Tidak ada data.";
    }

    // Menutup koneksi
    $conn->close();
} else {
    // Jika tidak ada data yang dikirimkan melalui POST, mungkin Anda ingin menampilkan formulir atau melakukan tindakan lainnya.
    echo "Tidak ada data yang dikirimkan melalui metode POST.";
}
?>
