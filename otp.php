<?php
require_once 'koneksi.php'; // Sesuaikan dengan file koneksi database Anda

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Cek apakah pengguna dengan username dan email tertentu ada di database
    $query = "SELECT * FROM users WHERE username = '$username' AND email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows === 1) {
        // Generate OTP
        $otp = rand(100000, 999999);

        // Simpan OTP ke database
        $updateQuery = "UPDATE users SET otp = '$otp' WHERE username = '$username'";
        $updateResult = $conn->query($updateQuery);

        if ($updateResult) {
            // Kirim OTP ke pengguna (implementasikan metode pengiriman yang sesuai, contohnya: email)
            $to = $email;
            $subject = 'Reset Password OTP';
            $message = "Your OTP is: $otp";
            $headers = 'From: adityabw230@gmail.com'; // Ganti dengan alamat email Anda

            // Uncomment line below to send OTP through email
            // mail($to, $subject, $message, $headers);

            $response = array('success' => true, 'message' => 'OTP sent successfully');
        } else {
            $response = array('success' => false, 'message' => 'Failed to update OTP');
        }
    } else {
        $response = array('success' => false, 'message' => 'User not found');
    }
} else {
    $response = array('success' => false, 'message' => 'Invalid request method');
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
