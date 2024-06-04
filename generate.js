function generateQRCode(text, width, height, callback)
{
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: text,
        width: width,
        height: height,
        colorDark: "#000000",  // Black foreground
        colorLight: "#ffffff", // White background
        correctLevel: QRCode.CorrectLevel.H
    });

    // Mengambil URL gambar QR code yang dihasilkan
    var qrCodeURL = qrcode._el.childNodes[0].toDataURL();

    // Mengirimkan URL gambar QR code ke dalam callback function
    if (callback && typeof(callback) === "function") {
        callback(qrCodeURL);
    }
}


