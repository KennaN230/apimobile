<?php
$localhostUrl = 'http://10.10.180.71//Griya/login.php'; // Ganti dengan URL server lokal Anda.

$context = stream_context_create(array(
    'http' => array(
        'timeout' => 5, // Waktu maksimum (dalam detik) untuk menunggu respons.
    )
));

$response = file_get_contents($localhostUrl, false, $context);

if ($response !== false) {
    echo 'Koneksi ke localhost berhasil';
} else {
    echo 'Koneksi ke localhost gagal';
}
?>
