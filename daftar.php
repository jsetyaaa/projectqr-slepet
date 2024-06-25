<?php
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

    <title>Daftar</title>
</head>

<body>

    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            
            <a href="index.php" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <img src="./asset/Logo.png" alt="QR Generator Logo" class="mx-auto"> <!-- Added mx-auto class -->
            </a>
            
            <div class="w-full bg-white rounded-md shadow-2xl border-black mt-0 sm:max-w-md xl:p-0 dark:bg-white-500 dark:border-gray-900">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-center text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-black">
                        Daftar Akun Baru
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="register.php" method="POST">
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Your
                                username</label>
                            <input type="username" name="username" id="username" class="w-96 p-3 border border-black" placeholder="username" required="">
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Your
                                email</label>
                            <input type="email" name="email" id="email" class="w-96 p-3 border border-black" placeholder="name@company.com" required="">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="w-96 p-3 border border-black" required="">
                        </div>
                        <button type="submit" class="w-96 bg-green-500 text-white p-3 rounded-md"> Daftar Akun</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Sudah punya akun? <a href="./login.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Masuk</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>