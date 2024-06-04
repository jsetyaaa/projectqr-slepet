<?php
// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memeriksa apakah variabel POST tersedia
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        // Mengambil nilai dari form
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Menghubungkan ke database
        include 'koneksi.php';

        // Memeriksa apakah username atau email sudah terdaftar
        $check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
        $result = $conn->query($check_query);

        if ($result->num_rows > 0) {
            // Jika username atau email sudah terdaftar, kembalikan ke daftar.php
            header("Location: daftar.php");
            exit();
        } else {
            // Jika username dan email belum terdaftar, hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Melakukan penyisipan data ke dalam tabel users
            $insert_query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

            // Menjalankan query
            if ($conn->query($insert_query) === true) {
                // Redirect ke halaman login setelah berhasil mendaftar
                header("Location: index.php");
                exit(); // Penting untuk menghentikan eksekusi selanjutnya setelah redirect
            } else {
                echo "Error: " . $insert_query . "<br>" . $conn->error;
            }
        }

        // Menutup koneksi
        $conn->close();
    } else {
        echo "All fields are required";
    }
}
