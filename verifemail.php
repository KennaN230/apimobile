<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require __DIR__ . '/vendor/autoload.php'; // Sesuaikan dengan path ke autoload.php dari PHPMailer

// Fungsi untuk menghasilkan OTP
function generateOTP() {
    return rand(100000, 999999);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'koneksi.php'; // Sertakan file koneksi.php

    // Mendapatkan data dari permintaan POST
    $email = $_POST['Email'];

    // Validasi data (Anda dapat menambahkan validasi tambahan sesuai kebutuhan)
    if (empty($email)) {
        $response = array('status' => 'error', 'message' => 'Memerlukan alamat email');
    } else {
        // Generate OTP
        $otp = generateOTP();

        // Kirim email dengan OTP menggunakan PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Sesuaikan dengan server SMTP Anda
            $mail->SMTPAuth = true;
            $mail->Username = 'adityabw230@gmail.com'; // Sesuaikan dengan akun SMTP Anda
            $mail->Password = 'enmnlhajzpjrmchd'; // Sesuaikan dengan kata sandi SMTP Anda
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('adityabw230@gmail.com', 'Your Name');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Verification Code';
            $mail->Body = 'Your OTP is: ' . $otp;

            $mail->send();

            // Kirim respons sukses
            $response = array('status' => 'success', 'message' => 'OTP dikirim berhasil');
        } catch (Exception $e) {
            // Kirim respons error
            $response = array('status' => 'error', 'message' => 'Gagal mengirim OTP: ' . $mail->ErrorInfo);
        }
    }
} else {
    $response = array('status' => 'error', 'message' => 'Invalid request method');
}

// Mengembalikan respons dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);

?>
