<?php
// Mulai session
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum, alihkan ke halaman login
    header("Location: login.php");
    exit();
}

// Koneksi ke database
include 'koneksi.php';

// Query untuk mengambil data dari tabel history
$query = "SELECT * FROM history WHERE user_id = " . $_SESSION['user_id'];
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    <title>History</title>
</head>

<body class="bg-gray-200">
    <div class="container mx-auto p-4">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-around items-center mb-4">
                <div class="flex items-center ">
                    <img src="asset/Logo.png">
                </div>
                <div>
                    <h1 class="text-2xl font-bold"><div class=""></div></h1>
                </div>
                <button
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation"
                    aria-controls="drawer-navigation">
                    Show navigation
                </button>
            </div>

    <section class="container p-8">
        <h1 class="text-3xl font-bold text-center">HISTORY</h1>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-12">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-center">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Text
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Barcode
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                if ($result->num_rows > 0) {
                    $count = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700'>";
                        echo "<th scope='row' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>$count</th>";
                        echo "<td class='px-6 py-4'>" . $row['text'] . "</td>";
                        // Membuat link menuju folder dengan nama file gambar
                        echo "<td class='px-6 py-4'><a href='qr_codes/" . $row['barcode_file'] . "' target='_blank'>" . $row['barcode_file'] . "</a></td>";
                        echo "<td class='px-6 py-4'>
                        <a href='qr_codes/" . $row['barcode_file'] . "' download>
                        <button class='font-medium text-blue-600 dark:text-red-500 hover:underline'>Download</button>
                        </a>
                            <button class='font-medium text-red-600 dark:text-red-500 hover:underline ml-4' onclick=\"confirmDelete('" . $row['id'] . "')\">Hapus</button>
                            </td>";

                        echo "</tr>";
                        $count++;
                    }
                } else {
                    echo "<tr><td colspan='4'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

  <!--navigasi-->
<div id="drawer-navigation"
class="fixed top-0 left-0 z-40 w-64 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white"
tabindex="-1" aria-labelledby="drawer-navigation-label">
<h5 id="drawer-navigation-label" class="text-base font-semibold text-gray-500 uppercase dark:text-gray-400">Menu
</h5>
<button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation"
    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 end-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
            clip-rule="evenodd"></path>
    </svg>
    <span class="sr-only">Close menu</span>
</button>
<div class="py-4 overflow-y-auto">
    <ul class="space-y-2 font-medium">
        <li>
            <a href="./dashboard.php"
                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-black hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-black"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 22 21">
                    <path
                        d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                    <path
                        d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                </svg>
                <span class="ms-3">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="./history.php"
                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-black hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-black"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 18 20">
                    <path
                        d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap">History</span>
            </a>
        </li>
        <li>
            <a href="./logout.php"
                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-black hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 18">
                    <path
                        d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                </svg>
                <span class="ms-3">Logout</span>
            </a>
        </li>
    </ul>
</div>
</div>




    <script>
    function confirmDelete(id) {
        if (confirm("Apakah Anda yakin ingin menghapus entri ini?")) {
            // Redirect to delete script with entry ID
            window.location.href = "delete_entry.php?id=" + id;
        }
    }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>
