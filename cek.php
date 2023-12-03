<?php
require_once 'koneksi.php'; // Adjust according to your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['NKonsumen']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);

    // Check if the username or email already exists
    $checkQuery = "SELECT * FROM konsumen WHERE NKonsumen = '$name' OR Email = '$email'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Username or email already exists, send response
        $response = array('user_exists' => true, 'message' => 'Username or email already exists');
        echo json_encode($response);
    } else {
        // Username and email are unique, send success response
        $response = array('user_exists' => false, 'message' => 'Username and email are unique');
        echo json_encode($response);
    }
}
?>
