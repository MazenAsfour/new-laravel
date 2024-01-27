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
    $("#request_point").click(function (e) {
        e.preventDefault();
        $(this).text("Requesting");

        var form = $(this);
        $.ajax({
            type: "POST",
            url: "/save-request",
            data: {
                "_token": jQuery("#token").attr("content"),
            },
            success: function (data) {
                console.log(data);
                res = JSON.parse(data);
                if (res.success) {
                    $("#notice-request").show();
                    $("#request_point").hide();
                    var date = new Date();

                    date.setTime(date.getTime() + 1 * 60 * 1000);
                    var name = "request_point";
                    var value = true;
                    document.cookie =
                        name +
                        "=" +
                        value +
                        "; expires=" +
                        date.toUTCString() +
                        "; path=/";
                } else {
                    alert(res.error);
                }
            },
        });
    });
}, 300);
