<?php
require_once 'koneksi.php'; // Adjust according to your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Membuat koneksi di sini agar tetap terbuka selama operasi
    $conn = new mysqli($host, $username, $password, $database);

    // Menangani kesalahan koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Assuming 'Bawal' is payment amount and 'Titem' is quantity, modify these accordingly
    $paymentAmount = mysqli_real_escape_string($conn, $_POST['Bawal']);
    $quantity = mysqli_real_escape_string($conn, $_POST['Titem']);

    // Insert data into the database for pemesanan
    $insertQuery = "INSERT INTO pemesanan (IdPemesanan, PaymentAmount, Quantity) VALUES (NULL, ?, ?)";
    $insertStmt = mysqli_prepare($conn, $insertQuery);
    mysqli_stmt_bind_param($insertStmt, "ss", $paymentAmount, $quantity);

    if (mysqli_stmt_execute($insertStmt)) {
        $response = array('status' => 'success', 'message' => 'Order placed successfully');
    } else {
        $response = array('status' => 'error', 'message' => 'Order placement failed');
    }

    // Send the JSON response
    echo json_encode($response);

    // Close the prepared statements
    mysqli_stmt_close($insertStmt);
}
?>
