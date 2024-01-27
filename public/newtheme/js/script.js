setTimeout(() => {
    redirectUrl = "https://haythambr.github.io/restaurant/food_menu";

    var qrcode_home = document.querySelector("#qrcode");
    if (qrcode_home) {
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: redirectUrl,
            width: 200,
            height: 200,
            colorDark: "#ff6426",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H,
        });
    }

    var qrcode_home = document.querySelector("#qrcode_profile");
    if (qrcode_home) {
        var user_id = document.querySelector("#user_id_profile");
        var redirectUrl;

        redirectUrl =
            "https://haythambr.github.io/restaurant/food_menu?user_id=" +
            user_id.value;

        var qrcode = new QRCode(qrcode_home, {
            text: redirectUrl,
            width: 200,
            height: 200,
            colorDark: "#ff6426",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H,
        });
    }
}, 300);
