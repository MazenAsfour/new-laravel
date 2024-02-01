<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title id="title" title="@yield('title', 'home')">@yield('title', 'Laravel')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="/index.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    @stack('custom-scripts')

    <meta id="token" name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('custom-style')
    <style>
    .icon-button {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        color: #333333;
        background: #dddddd;
        border: none;
        outline: none;
        border-radius: 50%;
    }

    .icon-button:hover {
        cursor: pointer;
    }

    .icon-button:active {
        background: #cccccc;
    }

    .icon-button__badge {
        position: absolute;
        top: -10px;
        right: -10px;
        width: 25px;
        height: 25px;
        background: red;
        color: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
    }

    .date-notify {
        font-weight: 500
    }

    .bold {
        font-weight: bolder;
    }

    .total-points {
        background: #ff6426;
        padding: 9px;
        color: #fff;

    }

    #notificationModal .modal-body {
        max-height: 400px;
        overflow-x: auto;
        height: auto;
    }


    .user-points {
        display: flex;
        align-items: center;
        width: 100%;
        margin-top: 10px;
    }

    .points-label {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .points-display {
        font-size: 24px;
        color: #007bff;
        /* Set your desired color */
        margin-left: 5px;
    }

    .error-message {
        font-size: 18px;
        color: red;
        /* Set your desired color */
    }
    </style>


    </s.user-points>


    <script>
    $(document).ready(function() {
        $(".displayAnotherModel").click(function() {
            $('.modal-backdrop').css("display", "none");
        });



        $('.displayAnotherModel').click(function() {
            console.log('enter');
            $.ajax({
                url: '/fetch-notifications',
                method: 'GET',
                success: function(response) {
                    console.log(response);

                    if (Array.isArray(response)) {

                        $('.modal-body').html('');

                        $('#adminAcceptanceMessage').html('');

                        response.forEach(function(notification) {
                            processNotification(notification);
                        });
                    } else if (typeof response === 'object' && response !== null) {
                        $('.modal-body').html(''); // Clear existing content

                        $('#adminAcceptanceMessage').html('');

                        for (var key in response) {
                            if (response.hasOwnProperty(key)) {
                                var notification = response[key];
                                processNotification(notification);
                            }
                        }
                    } else {
                        console.error('Response is not an array or object:', response);
                    }
                },
                error: function(error) {
                    console.error('Failed to fetch notifications');
                }
            });
        });

        function processNotification(notification) {

            var message = '<p style="';

            message += 'background-color: ' + (notification.is_user_read ? '#FFFFFF' : '#FFFFCC') + ';';
            message += 'padding: 10px;">';

            message += 'The admin has accepted your request at ' + formatReadableDate(notification.updated_at);

            if (notification.status == 1) {
                message += ' <span class="badge bg-success">Admin Accepted</span>';

            }

            message += '</p>';
            $('.modal-body').prepend(message);

            if (notification.is_user_read == 0) {
                markNotificationAsReadByUser(notification.id);
            }
        }





        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        function markNotificationAsReadByUser(notificationId) {
            $.ajax({
                url: '/mark-notification-as-read-by-user/' + notificationId,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    console.log('Notification marked as read by user');
                },
                error: function(error) {
                    console.error('Failed to mark notification as read by user');
                }
            });
        }



        function fetchUnreadNotificationCount() {
            $.ajax({
                url: '/fetch-unread-notification-count',
                method: 'GET',
                success: function(response) {
                    // Update the badge with the fetched count
                    $('.icon-button__badge').text(response.count);
                },
                error: function(error) {
                    console.error('Failed to fetch unread notification count');
                }
            });
        }



        $('.displayAnotherModel').click(function() {
            fetchUnreadNotificationCount();
        });


        function checkForUnreadNotifications() {
            fetchUnreadNotificationCount();
            console.log('check');

        }
        setInterval(checkForUnreadNotifications, 10000);

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
    });
    </script>
</head>

<body>
    <div id="app">
        @includeFirst(['layouts/navbar'])
        @yield('content')
        @include('layouts/footer')
    </div>



    @stack('custom-script')
</body>

</html>