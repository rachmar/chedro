<!DOCTYPE html>
<html>
<head>
    @include('partials._header')

    @yield('css')

    <!-- Global Styles -->
    <style type="text/css">
        .swal2-popup {
            font-size: 1.6rem !important;
        }
    </style>

</head>

<body class="hold-transition skin-blue sidebar-mini">

  <div id="app">

    <div class="wrapper">
      
        @include('partials._navbar')

        <aside class="main-sidebar">
          @include('partials._sidebar')
        </aside>

      <div class="content-wrapper">

        <section class="content container-fluid">
          
          @yield('content')

        </section>

      </div>

        @include('partials._footer')

    </div>

  </div>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" ></script>

  @yield('script')

  <!-- Global Scripts -->
  @if (session('status'))
    <script type="text/javascript">
      swal(
        '{{ session("title") }}',
        '{{ session("status") }}',
        '{{ session("mode") }}'
      )
    </script>
  @endif

</body>
</html>