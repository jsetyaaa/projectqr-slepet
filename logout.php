<?php
// Memulai sesi
session_start();

// Menghapus semua variabel sesi
session_unset();

// Menghapus sesi
session_destroy();

// Redirect ke halaman login atau halaman lainnya
header("Location: index.php");
exit();
