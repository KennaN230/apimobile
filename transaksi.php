<?php
// Koneksi ke database MySQL
require_once 'koneksi.php';

$conn = new mysqli($host, $username, $password, $database);

// Check koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle request dari aplikasi Android
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari permintaan POST
    $cartItemsJson = $_POST['cartItems']; // Data JSON dari objek CartItem

    // Decode JSON menjadi array PHP
    $cartItems = json_decode($cartItemsJson, true);

    // Loop melalui setiap item dalam cartItems
    foreach ($cartItems as $item) {
        // Ambil data dari setiap item
        $productName = $item['Bawal'];
        $price = $item['TPembayaran'];
        $quantity = $item['TItem'];

        // Lakukan operasi yang diperlukan di database (misalnya, INSERT)
        $sql = "INSERT INTO pemesanan (TPembayaran, TItem, Bawal) VALUES ('$price', $quantity, $productName)";

        if ($conn->query($sql) !== TRUE) {
            $response = array('status' => 'error', 'message' => 'Error during insert: ' . $conn->error);
            echo json_encode($response);
            exit;
        }
    }

    $response = array('status' => 'success', 'message' => 'Data inserted successfully');
    echo json_encode($response);
}

// Tutup koneksi ke database
$conn->close();
?>
