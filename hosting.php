<?php
// URL to retrieve content from
$url = "https://griya-srikandi.tifa.myhost.id/srikandi/Project-Griya-Srikandi/index.html";

// Retrieving content from the URL using file_get_contents
$output = file_get_contents($url);

// Checking for errors during content retrieval
if ($output === false) {
    die("Error fetching content from the URL");
}

// Displaying the retrieved content
echo $output;
?>
