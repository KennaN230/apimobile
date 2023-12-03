<?php
require_once 'koneksi.php'; // Sesuaikan dengan file koneksi database Anda

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Your SQL query
    $sql = "SELECT NProduk, HJual FROM produk";

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
                $data[] = array(
                    'NamaProduk' => $row['NProduk'],
                    'HargaJual' => $row['HJual']
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
}

// Close the connection when you're done using it
$conn->close();
?>
