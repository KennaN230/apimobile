<?php
require_once 'koneksi.php'; // Adjust according to your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Membuat koneksi di sini agar tetap terbuka selama operasi
    $conn = new mysqli($host, $username, $password, $database);

    // Menangani kesalahan koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    $name = mysqli_real_escape_string($conn, $_POST['NKonsumen']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $phone = mysqli_real_escape_string($conn, $_POST['NoTelp']);
    $password = mysqli_real_escape_string($conn, $_POST['Password']);
    $address = mysqli_real_escape_string($conn, $_POST['AlamatKonsumen']);

    // Check if the username or email already exists using prepared statements
    $checkQuery = "SELECT * FROM konsumen WHERE NKonsumen = ? OR Email = ?";
    $checkStmt = mysqli_prepare($conn, $checkQuery);
    mysqli_stmt_bind_param($checkStmt, "ss", $name, $email);
    mysqli_stmt_execute($checkStmt);
    mysqli_stmt_store_result($checkStmt);

    if (mysqli_stmt_num_rows($checkStmt) > 0) {
        // Username or email already exists, send response
        $response = array('status' => 'error', 'message' => 'Username or email already exists');
        echo json_encode($response);
    } else {
        // Insert new record if username and email are unique using prepared statements
        $insertQuery = "INSERT INTO konsumen (IdKonsumen, NKonsumen, AlamatKonsumen, NoTelp, Email, Password) VALUES (NULL, ?, ?, ?, ?, ?)";
        $insertStmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($insertStmt, "sssss", $name, $address, $phone, $email, $password);

        if (mysqli_stmt_execute($insertStmt)) {
            $response = array('status' => 'success', 'message' => 'Registration successful');
        } else {
            $response = array('status' => 'error', 'message' => 'Registration failed');
        }

        echo json_encode($response);
    }

    // Close the prepared statements
    mysqli_stmt_close($checkStmt);
    mysqli_stmt_close($insertStmt);
}
?>
