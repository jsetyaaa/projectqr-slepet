<?php
// Memulai session
session_start();

// Memeriksa apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memeriksa apakah variabel POST tersedia
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Mengambil nilai dari form
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Menghubungkan ke database
        include 'koneksi.php';

        // Melakukan query untuk mendapatkan data pengguna berdasarkan username
        $query = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($query);

        if ($result->num_rows == 1) {
            // Jika data pengguna ditemukan
            $user = $result->fetch_assoc();

            // Memeriksa apakah password sesuai dengan hash yang disimpan di database
            if (password_verify($password, $user['password'])) {
                // Jika password sesuai, menyimpan user_id dalam session
                $_SESSION['user_id'] = $user['user_id'];
                // Redirect ke halaman dashboard atau halaman sukses lainnya
                header("Location: dashboard.php");
                exit();
            } else {
                // Jika password tidak sesuai, tampilkan pesan kesalahan
                $error = "Incorrect password";
            }
        } else {
            // Jika data pengguna tidak ditemukan, tampilkan pesan kesalahan
            $error = "User not found";
        }

        // Menutup koneksi
        $conn->close();
    } else {
        // Jika salah satu atau kedua variabel POST tidak tersedia, tampilkan pesan kesalahan
        $error = "Both username and password are required";
    }
}
