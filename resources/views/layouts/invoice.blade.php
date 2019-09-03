<!DOCTYPE html>
<html>
<head>
    @include('partials._header')
    <style type="text/css">
    	#transactions {
		  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		  border-collapse: collapse;
		  width: 100%;
		}

		#transactions td, #transactions th {
		  border: 1px solid black;
		  padding: 8px;
		}

		#transactions th {
		  padding-top: 12px;
		  padding-bottom: 12px;
		  text-align: left;
		  background-color: #4CAF50;
		  color: white;
		}		
    </style>
</head>
<body>
  <div id="app">
    @yield('content')
  </div>
  <script type="text/javascript">
  	window.print();
  </script>
</body>
</html>