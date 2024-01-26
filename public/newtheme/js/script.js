console.log('safdddasasdsdasdasad');
var redirectUrl = "https://haythambr.github.io/restaurant/food_menu";
var qrcode = new QRCode(document.getElementById("qrcode"), {
    text: redirectUrl,
    width: 200,
    height: 200,
    colorDark: "#ff6426",
    colorLight: "#ffffff",
    correctLevel: QRCode.CorrectLevel.H,
});

