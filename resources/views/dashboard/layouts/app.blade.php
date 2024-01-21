<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield("title","Royal Moon")</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    @stack('custom-style')

    <!-- bootstrap css -->
    <link rel="stylesheet" href="/admin/css/bootstrap.min.css" />
    <!-- site css -->
    <link rel="stylesheet" href="/admin/style.css" />
    <link rel="stylesheet" href="/admin/css/admin.css" />

    <!-- responsive css -->
    <link rel="stylesheet" href="/admin/css/responsive.css" />
    <link rel="stylesheet" href="/admin/css/bootstrap-select.css" />
    <!-- scrollbar css -->
    <link rel="stylesheet" href="/admin/css/perfect-scrollbar.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="/admin/css/custom.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Styles -->
    <link rel="shortcut icon" sizes="114x114" href="{{ asset('images/favicon.ico') }}">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body>
    <div id="">
        @includeFirst(['dashboard/layouts/header'])
            @yield('content')
        @include('dashboard/layouts/footer')
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    @stack('custom-script')
      <!-- jQuery -->
      <script src="/admin/js/jquery.min.js"></script>
      <script src="/admin/js/popper.min.js"></script>
      <script src="/admin/js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="/admin/js/animate.js"></script>
      <!-- select country -->
      <script src="/admin/js/bootstrap-select.js"></script>
      <!-- owl carousel -->
      <script src="/admin/js/owl.carousel.js"></script> 
      <!-- chart js -->
      <script src="/admin/js/Chart.min.js"></script>
      <script src="/admin/js/Chart.bundle.min.js"></script>
      <script src="/admin/js/utils.js"></script>
      <script src="/admin/js/analyser.js"></script>
      <!-- nice scrollbar -->
      <script src="/admin/js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar')
      </script>
      <!-- custom js -->
      <script src="/admin/js/custom.js"></script>
      <script src="/admin/js/chart_custom_style1.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>
