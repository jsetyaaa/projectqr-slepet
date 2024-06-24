<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not, send an error response
    echo json_encode(array("success" => false, "error" => "User is not logged in"));
    exit();
}

// Database connection
include 'koneksi.php';

// Check if QR code data URL and text are received
if (isset($_POST['qrcode']) && isset($_POST['text'])) {
    $dataURL = $_POST['qrcode'];
    $text = $_POST['text'];

    // Validate the QR code data URL
    if (!preg_match('/^data:image\/png;base64,/', $dataURL)) {
        echo json_encode(array("success" => false, "error" => "Invalid QR code format"));
        exit();
    }

    // Generate a unique file name
    $fileName = uniqid() . ".jpg"; // Use JPEG format

    // Create a white background image with size 200x200
    $image = imagecreatetruecolor(200, 200);
    $white = imagecolorallocate($image, 255, 255, 255);
    imagefill($image, 0, 0, $white);

    // Create QR code image from the data URL
    $qrCode = imagecreatefromstring(base64_decode(str_replace('data:image/png;base64,', '', $dataURL)));

    // Check if QR code image creation was successful
    if (!$qrCode) {
        echo json_encode(array("success" => false, "error" => "Error decoding QR code image"));
        exit();
    }

    // Get QR code image dimensions
    $qrCodeWidth = imagesx($qrCode);
    $qrCodeHeight = imagesy($qrCode);

    // Draw the QR code image in the center of the white background
    $x = (200 - $qrCodeWidth) / 2;
    $y = (200 - $qrCodeHeight) / 2;
    imagecopy($image, $qrCode, $x, $y, 0, 0, $qrCodeWidth, $qrCodeHeight);

    // Save the image in JPEG format with quality 100%
    $savePath = 'qr_codes/' . $fileName; // Add a slash at the end of the path
    $filePath = $savePath; // Define $filePath
    if (imagejpeg($image, $filePath, 100)) {
        // Destroy the image resources to free memory
        imagedestroy($image);
        imagedestroy($qrCode);

        // Save entry into history table
        $user_id = $_SESSION['user_id'];
        
        // Prepare an SQL statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO history (user_id, text, barcode_file) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $text, $fileName);

        if ($stmt->execute()) {
            // If successful, send JSON response with file information
            echo json_encode(array("success" => true, "fileURL" => "qr_codes/$fileName", "fileName" => $fileName));
        } else {
            // If there is an error saving to the database, send error response
            echo json_encode(array("success" => false, "error" => "Error saving to database: " . $stmt->error));
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // If there is an error saving the image, send error response
        echo json_encode(array("success" => false, "error" => "Error saving image"));
    }

    // Close the database connection
    $conn->close();
} else {
    // If QR code data URL is not received, send error response
    echo json_encode(array("success" => false, "error" => "Data URL QRCode not received"));
}
?>
