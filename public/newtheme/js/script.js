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

$(document).ready(function() {
    $(".displayAnotherModel").click(function() {
        $('.modal-backdrop').css("display", "none");
    });

    getData();

    $('.noti:not(.show)').click(function() {
        $.ajax({
            url: '/markAsReadByUser',
            method: 'GET',
            success: function(data) {
                
            }
        });      
    });

    function getData(){
        $.ajax({
            url: '/fetch-notifications',
            method: 'GET',
            success: function(data) {
                response = JSON.parse(data);

                if(response.success){
                    if(response.data.length > 0 ){
                        $('.modal-body').html('');
                        $('#adminAcceptanceMessage').html('');
                        for(var i in response.data){
                            processNotification(response.data[i]);
                        }
                    }
                    jQuery("#countNoti").text(response.unreadData);
                    $('.modal-footer').html(
                        `
                        <p class="points-label" style="width:100%">Total Points: <span
                        class="points-display">${response.totalPointes}</span></p>
                        `
                        );
                }
            },
            error: function(error) {
                console.error('Failed to fetch notifications');
            }
        });
    }
    function processNotification(notification) {

        var message = '<p style="';

        message += 'background-color: ' + (notification.is_user_read ? '#FFFFFF' : '#FFFFCC') + ';';
        message += 'padding: 10px;">';

        message += 'The admin has accepted your request at ' + formatReadableDate(notification.created_at);

        if (notification.status == 1) {
            message += ' <span class="badge bg-success">Admin Accepted</span>';

        }

        message += '</p>';
        $('.modal-body').prepend(message);

        
    }





    var csrfToken = $('meta[name="csrf-token"]').attr('content');



    function checkForUnreadNotifications() {
        getData();
        console.log('check');

    }
    setInterval(checkForUnreadNotifications, 1000);

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
        };

        var formattedDate = date.toLocaleDateString("en-US", optionsDate);
        var formattedTime = date.toLocaleTimeString("en-US", optionsTime);

        return formattedDate + " " + formattedTime;
    }
});