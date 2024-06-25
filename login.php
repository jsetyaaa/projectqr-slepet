<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Mulai session
session_start();

// Periksa apakah pengguna sudah login
if (isset($_SESSION['user_id'])) {
    // Jika sudah, alihkan ke halaman dashboard
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    <title>Login</title>
</head>

<body class="flex items-center min-h-screen bg-gray-100">
    <div class="flex flex-row max-w-3xl mx-auto">
        <div class="flex flex-col items-center w-full"> <!-- Added flex-col, items-center and w-full classes -->
            <div class="justify-center w-full mt-4" style="text-align: center;"> 
                <img src="./asset/Logo.png" alt="QR Generator Logo" class="mx-auto"> <!-- Added mx-auto class -->
                <h1 class="font-bold text-center mt-16">Ubah Informasi Anda Menjadi <span class="text-blue-600">QR CODE</span> Dalam Hitungan Detik</h1>
                <h2 class="text-center text-green-500 mt-4 mb-11">Sederhana, Cepat. Dan Mudah</h2>

                <form class="space-y-4 md:space-y-6" action="login_process.php" method="POST">
                    <input type="username" name="username" id="username" class="w-96 p-3 border border-black" placeholder="Username">
                    <input type="password" name="password" id="password" class="w-96 p-3 border border-black" placeholder="Password">
                    <button type="submit" class="w-96 bg-blue-500 text-white p-3 rounded-md">Masuk</button>   
                </form>

                <div class="flex items-center justify-center my-7">
                    <div class="w-full border-t border-gray-300"></div>
                    <span class="mx-4 text-gray-500">or</span>
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <button onclick="window.location.href='./daftar.php';" type="button" class="w-96 bg-green-500 p-3 text-white rounded-md"> Daftar</button>
                <p class="text-center mt-6">Belum punya akun? <a href="./daftar.php" class="text-blue-500">Daftar</a></p>
            </div>
        </div>
    </div>
</body>
    
</html>
