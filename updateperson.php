<?php

require_once 'koneksi.php';

// Check if all required parameters are set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['NKonsumen']) && isset($_POST['Password']) && isset($_POST['AlamatKonsumen']) && isset($_POST['NoTelp']) && isset($_POST['Email'])) {
    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Sanitize input data
    $name = ($_POST['NKonsumen']);
    $password = ($_POST['Password']);
    $address = ($_POST['AlamatKonsumen']);
    $phoneNumber = ($_POST['NoTelp']);
    $email = ($_POST['Email']);

    // Update the user in the database
    $sql = "UPDATE konsumen SET Password = '$password', AlamatKonsumen = '$address', NoTelp = '$phoneNumber', Email = '$email' WHERE NKonsumen = '$name'";

    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully";
    } else {
        echo "Error during update: " . $conn->error;
    }

} else {
    echo "Missing required parameters";
}

// Close the database connection
$conn->close();

?>
