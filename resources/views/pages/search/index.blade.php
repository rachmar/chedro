<!DOCTYPE html>
<html>
<head>
    @include('partials._header')
    
</head>

<body class="skin-blue layout-top-nav ">

  <div id="app">
   
    <div class="container">
      <h1>Scan Now</h1>
      <input type="input" id="forced" class="form-control" name="asdasd" autofocus="on">
    </div>

  </div>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" ></script>
  <script type="text/javascript">
    $("#forced").blur(function(){
      $(this).focus();       
    });
  </script>
</body>
</html>
