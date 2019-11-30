<!DOCTYPE html>
<html>
<head>
    @include('partials._header')
    
    @yield('css')

</head>

<body class="skin-blue layout-top-nav ">

  <div id="app">

    <div class="wrapper">

        @include('partials._navbar')

      <div class="content-wrapper">

        <div class="container">

          <section class="content">

            @yield('content')

          </section>

        </div>
        

      </div>

        @include('partials._footer')

    </div>

  </div>



  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" ></script>

  @yield('script')

  <!-- SweetAlert Trigger -->
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
