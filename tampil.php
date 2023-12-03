<?php
require_once 'koneksi.php'; // Sesuaikan dengan file koneksi database Anda

// Your SQL query
$sql = "SELECT NProduk, HJual, gambarproduk FROM produk";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Check if there are rows in the result set
if ($result->num_rows > 0) {
    // Fetch data and display
    while ($row = $result->fetch_assoc()) {
        echo "Nama Produk: " . $row['NProduk'] . "<br>";
        echo "Harga Jual: " . $row['HJual'] . "<br>";

        // Display image directly from file path
        $imagePath = $row['gambarproduk'];

        // Check if the file exists
        if (file_exists($imagePath)) {
            // Check if the file is a valid image
            $imageInfo = getimagesize($imagePath);
            if ($imageInfo !== false) {
                // Display the image
                echo '<img src="' . $imagePath . '" alt="Product Image" style="max-width: 300px;"><br>';
            } else {
                echo "Invalid image file: $imagePath<br>";
            }
        } else {
            echo "Image not found: $imagePath<br>";
        }
    }
} else {
    echo "No records found";
}

// Close the result set
$result->close();

// Close the connection when you're done using it
$conn->close();
?>
