<?php
// Mulai session
session_start();

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum, kirimkan respon error
    echo json_encode(array("success" => false, "error" => "User is not logged in"));
    exit();
}

// Koneksi ke database
include 'koneksi.php';

// Menerima data URL dari gambar QRCode dan nilai teks
if (isset($_POST['qrcode']) && isset($_POST['text'])) {
    $dataURL = $_POST['qrcode'];
    $text = $_POST['text']; // Mendapatkan nilai text-input

    // Membuat nama file acak
    $fileName = uniqid() . ".jpg"; // Menggunakan format JPEG

    // Membuat gambar latar belakang putih dengan ukuran 500x500
    $image = imagecreatetruecolor(500, 500);
    $white = imagecolorallocate($image, 255, 255, 255);
    imagefill($image, 0, 0, $white);

    // Membuat gambar QR Code dari data URL
    $qrCode = imagecreatefromstring(base64_decode(str_replace('data:image/png;base64,', '', $dataURL)));

    // Mendapatkan dimensi gambar QR Code
    $qrCodeWidth = imagesx($qrCode);
    $qrCodeHeight = imagesy($qrCode);

    // Menggambar gambar QR Code di tengah gambar latar belakang putih
    $x = (500 - $qrCodeWidth) / 2;
    $y = (500 - $qrCodeHeight) / 2;
    imagecopy($image, $qrCode, $x, $y, 0, 0, $qrCodeWidth, $qrCodeHeight);

    // Simpan gambar ke dalam format JPEG dengan kualitas 100%
    if (imagejpeg($image, "qr_codes/$fileName", 100)) {
        // Hapus gambar dari memori
        imagedestroy($image);

        // Menyimpan entri ke dalam tabel history
        $user_id = $_SESSION['user_id'];
        $query = "INSERT INTO history (user_id, text, barcode_file) VALUES ('$user_id', '$text', '$fileName')";
        if ($conn->query($query) === TRUE) {
            // Jika berhasil menyimpan ke database, kirimkan respon JSON dengan informasi file untuk alert
            echo json_encode(array("success" => true, "fileURL" => "qr_codes/$fileName", "fileName" => $fileName));
        } else {
            // Jika terjadi kesalahan saat menyimpan ke database, kirimkan respon error
            echo json_encode(array("success" => false, "error" => "Error saving to database: " . $conn->error));
        }
    } else {
        // Jika terjadi kesalahan saat menyimpan gambar, kirimkan respon error
        echo json_encode(array("success" => false, "error" => "Error saving image"));
    }

    // Menutup koneksi
    $conn->close();
} else {
    // Jika data URL tidak diterima, kirimkan respon error
    echo json_encode(array("success" => false, "error" => "Data URL QRCode not received"));
}
