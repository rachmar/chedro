<!DOCTYPE html>
<html>
<head>
    @include('partials._header')

    @yield('css')

</head>

<body class="hold-transition skin-blue sidebar-mini">

  <div id="app">


    <div class="wrapper">

      @include('partials._navbar')

      <aside class="main-sidebar">

        @include('partials._sidebar')

      </aside>
      <div class="content-wrapper">

        <section class="content-header">

          <div class="row">
            <div class="col-xs-10">
              <h2 style="margin-top:0px !important;margin-bottom:0px !important;">Logs</h2>
            </div>
            <div class="col-xs-2">
              <a href="{{ route('export') }}" class="btn btn-success" style="float:right;"><i class="fa fa-file-excel-o"></i></a>

            </div>
          </div>

        </section>

        <section class="content container-fluid">

          @yield('content')

        </section>

      </div>

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
