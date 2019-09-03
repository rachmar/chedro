<!DOCTYPE html>
<html>
<head>
    @include('partials._header')

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body class="hold-transition" style="background-color: #d2d6de;">

  <div id="app">

    @yield('content')

  </div>

  <script src="{{ asset('js/app.js') }}" ></script>

</body>
</html>