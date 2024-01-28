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

    $(document).ready(function () {
        $(".displayAnotherModel").click(function () {
            $(".modal-backdrop").css("display", "none");
            setTimeout(() => {
                $.ajax({
                    url: "/mark-as-read",
                    method: "GET",
                    success: function (data) {
                        var response = JSON.parse(data);
                    },
                    error: function (error) {
                        console.error("Failed to fetch notifications", error);
                    },
                });
            }, 1000);
        });

        getUnreadNotifications();
        function checkForUnreadNotifications() {
            getUnreadNotifications();
        }
        setInterval(checkForUnreadNotifications, 60000);
    });
}, 300);
function getUnreadNotifications() {
    $.ajax({
        url: "/fetch-notifications",
        method: "GET",
        success: function (data) {
            response = JSON.parse(data);

            if (response.success) {
                var html = "";
                $("#notificationModal .modal-body").html("");

                if (response.data.length) {
                    for (var i in response.data) {
                        var notification = response.data[i];
                        if (
                            Number(notification.is_user_read) == 0 &&
                            Number(notification.status) == 1
                        ) {
                            var classWeight = "bold";
                            var classcolor = "#FFFFCC";
                            var msg =
                                "The admin has accepted one point at <span class='date-notify'>" +
                                formatReadableDate(notification.updated_at);
                        } else if (
                            Number(notification.is_user_read) == 1 &&
                            Number(notification.status) == 1
                        ) {
                            var classWeight = "";
                            var classcolor = "#FFFFCC";
                            var msg =
                                "The admin has accepted one point at <span class='date-notify'>" +
                                formatReadableDate(notification.updated_at);
                        } else {
                            var classWeight = "";
                            var classcolor = "#f3f3f3";
                            var msg =
                                "This request until review <span class='date-notify'>" +
                                formatReadableDate(notification.updated_at);
                        }
                        html +=
                            "<p class='" +
                            classWeight +
                            "' style='background-color:" +
                            classcolor +
                            ";padding:10px;margin-top:8px'>" +
                            msg +
                            "</span></p>";
                    }
                }
                $("#notificationModal .modal-footer").html(
                    "<div class='total-points d-block w-100'>Total Points : " +
                        response.total_points +
                        "</div>"
                );
                $(".displayAnotherModel .icon-button__badge").text(
                    response.unreaded
                );
                $("#notificationModal .modal-body").append(html);
            }
        },
        error: function (error) {
            console.error("Failed to fetch notifications");
        },
    });
}

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
function formatReadableDate(dateString) {
    var date = new Date(dateString);

    var optionsDate = {
        year: "numeric",
        month: "short",
        day: "numeric",
    };
    var optionsTime = {
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
        // timeZoneName: 'short'
    };

    var formattedDate = date.toLocaleDateString("en-US", optionsDate);
    var formattedTime = date.toLocaleTimeString("en-US", optionsTime);

    return formattedDate + " " + formattedTime;
}
