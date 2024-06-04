<?php
// Informasi koneksi database
$servername = "localhost";
$usernamedb = "${{ secrets.DB_USERNAME }}";
$password = "${{ secrets.DB_PASSWORD }}";
$database = "${{ secrets.DB_DATABASE }}";

// Buat koneksi
$conn = new mysqli($servername, $usernamedb, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
