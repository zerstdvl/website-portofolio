<?php
$host = "localhost"; // Configure According your database
$user = "root"; // Username MySQL (default: root)
$password = ""; // Password MySQL (Leave this blank if default config on localhost.)
$dbname = "portfolio_db"; // Name database

// Connection to database
$conn = new mysqli($host, $user, $password, $dbname);

// Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
