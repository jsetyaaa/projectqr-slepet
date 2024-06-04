<?php
// Mulai session
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum, kirimkan respon error
    echo json_encode(array("success" => false, "error" => "User is not logged in"));
    exit();
}

// Koneksi ke database
include 'koneksi.php';

// Periksa apakah ada ID yang diterima
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus gambar dari folder
    $query_select = "SELECT barcode_file FROM history WHERE id = $id AND user_id = " . $_SESSION['user_id'];
    $result_select = $conn->query($query_select);

    if ($result_select->num_rows > 0) {
        $row_select = $result_select->fetch_assoc();
        $filePath = "qr_codes/" . $row_select['barcode_file'];

        // Periksa apakah file ada
        if (file_exists($filePath)) {
            // Hapus file
            if (unlink($filePath)) {
                
            } else {
                header("Location: history.php");
                exit();
            }
        }

    // Hapus entri dari tabel history setelah menghapus gambar
    $query_delete = "DELETE FROM history WHERE id = $id AND user_id = " . $_SESSION['user_id'];
    if ($conn->query($query_delete) === true) {
        // Redirect back to history page
        header("Location: history.php");
        exit();
    } else {
        // Jika terjadi kesalahan saat menghapus dari database, kirimkan respon error
        echo json_encode(array("success" => false, "error" => "Error deleting entry: " . $conn->error));
        exit();
    }
} else {
    // Jika tidak ada ID yang diterima, kirimkan respon error
    echo json_encode(array("success" => false, "error" => "No entry ID received"));
    exit();
}

}

// Menutup koneksi
$conn->close();