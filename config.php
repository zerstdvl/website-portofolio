<?php
$host = "localhost"; // Sesuaikan dengan host database Anda
$user = "root"; // Username MySQL (default: root)
$password = ""; // Password MySQL (kosong jika di localhost)
$dbname = "portfolio_db"; // Nama database

// Buat koneksi
$conn = new mysqli($host, $user, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
