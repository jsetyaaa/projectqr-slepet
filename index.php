<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Generator</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

</head>

<body class="bg-white font-sans">
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <img src="./asset/Logo.png" alt="QR Generator Icon">
            </div>
            <div class="flex flex-col md:flex-row justify-betwen m-4">
                <a href="login.php" class="border-solid border-4 border-blue-500 text-blue-500 py-1 px-4 rounded mx-2 my-2">Log In</a>
                <a href="daftar.php" class="bg-green-500 text-white py-2 px-4 rounded mx-2 my-2">Register</a>
            </div>
        </div>

        <div class="flex flex-col md:flex-row justify-around items-start mt-10 md:mt-36 ">
            <div class="flex flex-col max-w-lg">
                <h1 class="text-6xl font-bold text-blue-500 mt-4">QR<span class="text-green-500 text-5xl">Generator</span></h1>
                <p class="mt-4 text-gray-700 font-bold">
                Buat QR Code dengan mudah dan praktis menggunakan QR-Generator!. Anda bisa menciptakan kode QR yang stylish dan informatif dalam hitungan detik. 
                QR-Generator memudahkan Anda untuk mengubah informasi menjadi QR Code menarik secara praktis, sederhana, dan aman. 
                </p>
                <button onclick="window.location.href='./login.php';" class="mt-6 bg-green-500 text-white py-2 px-6 rounded-full w-full">GET STARTED</button>
            </div>

            <div class="item-center mt-4">
                <img src="./asset/phone.png" alt="Illustrative Image" class="w-50 h-auto">
            </div>
        </div>
    </div>
</body>

</html>
