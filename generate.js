// Event listener for generate button
document.getElementById('generate-button').addEventListener('click', function () {
    generateQRCode();
});

function generateQRCode(text, width, height, callback)
{
    var qrcodeContainer = document.getElementById("qrcode");
    qrcodeContainer.innerHTML = ""; // Bersihkan container QR code sebelumnya

    var qrcode = new QRCode(qrcodeContainer, {
        text: text,
        width: 200,
        height: 200,
        colorDark: "#000000",  // Hitam untuk foreground
        colorLight: "#ffffff", // Putih untuk background
        correctLevel: QRCode.CorrectLevel.H
    });

    // Gunakan timeout untuk memastikan QR code telah dihasilkan sebelum mengambil data URL
    setTimeout(function () {
        var canvas = qrcodeContainer.getElementsByTagName('canvas')[0];
        var qrCodeURL = canvas.toDataURL();
        callback(qrCodeURL);
    }, 1000);
}

function downloadQR()
{
    var text = document.getElementById("text-input").value.trim();
    if (!text) {
        alert("Please generate a QR code first by entering some text.");
        return;
    }

    generateQRCode(text, 200, 200, function (qrCodeURL) {
        // Buat link untuk download
        var link = document.createElement('a');
        link.download = 'qrcode.png'; // Nama file yang akan di-download
        link.href = qrCodeURL;

        // Tambahkan link ke dalam dokumen, klik secara otomatis, lalu hapus link
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        // Mengirimkan URL gambar QR code ke server menggunakan AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "save_qr.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Mengonversi respon menjadi JSON
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Jika penyimpanan berhasil, tampilkan pesan sukses
                    alert("QR Code berhasil disimpan dengan nama: " + response.fileName);
                    // Refresh halaman
                    // location.reload();
                } else {
                    // Jika terjadi kesalahan, tampilkan pesan kesalahan
                    console.error("Error saving QR code: " + response.error);
                }
            }
        };
        xhr.send("qrcode=" + encodeURIComponent(qrCodeURL) + "&text=" + encodeURIComponent(text));
    });
}

document.getElementById("generate-button").addEventListener("click", function () {
    var text = document.getElementById("text-input").value.trim();
    if (!text) {
        alert("Please enter some text.");
        return;
    }

    generateQRCode(text, 200, 200, function (qrCodeURL) {
        // Set QR code image source
        var qrcodeImage = document.getElementById("qrcode");
        if (qrcodeImage) {
            qrcodeImage.src = qrCodeURL;
        } else {
            console.error("Failed to find QR code image element.");
        }
    });
});
