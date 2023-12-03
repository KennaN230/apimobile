<?php
require_once 'koneksi.php'; // Include your database connection file

// Your SQL query
$sql = "SELECT NProduk, HJual, Image FROM produk";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    die("Query failed: " . $conn->error);
}

// Check if there are rows in the result set
if ($result->num_rows > 0) {
    // Fetch data and display
    while ($row = $result->fetch_assoc()) {
        echo "Nama Produk: " . $row['NProduk'] . "<br>";
        echo "Harga Jual: " . $row['HJual'] . "<br>";

        // Display image directly from file path
        $imagePath = $row['Image'];
        echo '<img src="' . $imagePath . '" alt="Product Image" style="max-width: 300px;"><br>';
    }
} else {
    echo "No records found";
}

// Close the result set
$result->close();

// Close the connection when you're done using it
$conn->close();
?>
