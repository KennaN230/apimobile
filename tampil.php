<?php
require_once 'koneksi.php'; // Sesuaikan dengan file koneksi database Anda

// Your SQL query
$sql = "SELECT NProduk, HJual, gambarproduk FROM produk";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if (!$result) {
    $response = array('status' => 'error', 'message' => 'Query failed: ' . $conn->error);
    echo json_encode($response);
} else {
    // Check if there are rows in the result set
    if ($result->num_rows > 0) {
        // Fetch data and build an array
        $data = array();
        while ($row = $result->fetch_assoc()) {
            // Convert BLOB image data to Base64
            $imageData = $row['gambarproduk'];
            $imageBase64 = base64_encode($imageData);

            $data[] = array(
                'NamaProduk' => $row['NProduk'],
                'HargaJual' => $row['HJual'],
                'ImageBase64' => $imageBase64
            );
        }

        // Send JSON response
        $response = array('status' => 'success', 'data' => $data);
        echo json_encode($response);
    } else {
        $response = array('status' => 'error', 'message' => 'No records found');
        echo json_encode($response);
    }

    // Close the result set
    $result->close();
}

// Close the connection when you're done using it
$conn->close();
?>
