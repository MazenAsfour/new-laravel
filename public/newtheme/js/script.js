setTimeout(() => {
    redirectUrl = "https://haythambr.github.io/restaurant/food_menu";
 
    if (getCookie("request_point")) {
        $("#notice-request").show();
        $("#request_point").hide();
    }
    $("#request_point").click(function (e) {
        e.preventDefault();
        $(this).text("Requesting");

        var form = $(this);
        $.ajax({
            type: "POST",
            url: "/save-request",
            data: {
                _token: jQuery("#token").attr("content"),
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



function getCookie(name) {
    var nameEQ = name + "=";
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        while (cookie.charAt(0) === " ") {
            cookie = cookie.substring(1, cookie.length);
        }
        if (cookie.indexOf(nameEQ) === 0) {
            return cookie.substring(nameEQ.length, cookie.length);
        }
    }

    return null;
}

