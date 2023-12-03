<?php
// updateProfileWithBlobImage.php

include 'koneksi.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id']; // ID pengguna yang akan diperbarui
$username = $data['username'];
$email = $data['email'];
$phoneNumber = $data['phoneNumber'];

$image = $_FILES["image"]["tmp_name"];
$imageContent = addslashes(file_get_contents($image));

$sql = 'UPDATE users SET username = ?, email = ?, phone_number = ?, image = ? WHERE id = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssssi', $username, $email, $phoneNumber, $imageContent, $id);

$response = array();

if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['error'] = 'Internal Server Error';
}

echo json_encode($response);

$stmt->close();
$conn->close();
?>
