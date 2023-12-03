<?php
require_once 'koneksi.php';

// Mengambil data produk dari database
$sql = "SELECT KProduk, NProduk, HJual, Image FROM produk";
$result = $conn->query($sql);

// Menangani kesalahan query
if ($result === false) {
    die("Query failed: " . $conn->error);
}

// Menyimpan hasil dalam bentuk array asosiatif
$rows = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Mengonversi gambar ke dalam format Base64
        $imageBase64 = base64_encode($row['Image']);
        
        // Hapus kolom Image dari array atau beri nama yang berbeda jika tidak ingin menyertakan gambar secara langsung dalam JSON
        unset($row['Image']);
        
        // Tambahkan hasil konversi gambar sebagai kolom baru
        $row['ImageBase64'] = $imageBase64;

        // Tambahkan URL gambar sebagai kolom baru (gantilah 'nama_field_gambar' dengan nama field gambar di tabel)
        $row['ImageUrl'] = "https://example.com/path/to/images/" . $row['nama_field_gambar'];
        
        $rows[] = $row;
    }
}

// Menutup koneksi
$conn->close();

// Mengirimkan data dalam format JSON dengan header Content-Type
header('Content-Type: application/json');
echo json_encode($rows);
?>
