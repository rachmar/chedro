<!DOCTYPE html>
<html>
<head>
    @include('partials._header')
    <style>
      @page { size: auto;  margin: 0mm; }
      @media print {
         #print {
             display: none;
          }
      }
    </style>
</head>

<body class="skin-blue layout-top-nav ">

  <div id="app">
    <table class="table table-bordered">
      <tbody>
          <tr>
              <td>
                Control ID : {{ $control_id }}
                <br/>
                Instituion Name : {{ $institution->name }}
                <br/>
                Document Name : {{ $document->name }}
              </td>
              <td>
                <img src="data:image/png;base64,{{ $baseImage64 }}" alt="barcode" />
              </td>
          </tr>
      </tbody>
  </table>
  <button id="print">Click Here To Print</button>
  </div>


  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" ></script>
  <script type="text/javascript">
    $("#print").click(function() {
      window.print();
    });
  </script>
</body>
</html>
