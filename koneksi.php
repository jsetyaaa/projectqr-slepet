<?php
// Informasi koneksi database
$servername = "localhost";
$usernamedb = "root";
$password = "";
$database = "qrgenerator";

// Buat koneksi
$conn = new mysqli($servername, $usernamedb, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
