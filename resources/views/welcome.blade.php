<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="hold-transition">

    <div id="app">
        <div class="row">
          <a href="{{route('home')}}">Home Click Here!</a>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Gold</h3> 
                  <button id="refresh" class="btn btn-sm btn-success pull-right">Refresh Live Prices</button>

                  <a href="{{route('home')}}" class="btn btn-sm btn-success pull-right" >Home Click Here!</a>

                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                              <th colspan="2">Live Price: GBP £ <span class="lgold gbp">{{ $metal->lgold }}</span> /oz</th>
                            </tr>
                            <tr>
                              <th>Enter Weight</th>
                              <th>Description</th>
                              <th><input type="number" id="cgp" value="100" min="1" max="100"> % of market value at GBP £ 
                                <span class="lgold">{{ $metal->lgold }}</span> /oz</th>
                            </tr>
                            @foreach ($karats as $karat)
                                <tr>
                                    <td>
                                        <input type="number"
                                               class="enter-weight"
                                               id="input-{{ $karat->id }}" 
                                               data-id="{{ $karat->id }}"
                                               data-value="{{ $karat->value }}"
                                               value="1">
                                    </td>
                                    <td>{{ $karat->name }} Gold</td>
                                    <td>
                                        GBP £ <span id="market-value-{{ $karat->id }}" 
                                                    class="price"
                                                    data-id="{{ $karat->id }}"
                                                    data-grams="{{ $karat->grams }}"
                                                    data-value="{{ $karat->value }}"
                                                    >{{ number_format(((($metal->lgold/31.104) * $karat->value) * (100 * 0.01)), 2) }}</span> /g 
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
         </div>
    </div>

  <script src="{{ asset('js/app.js') }}" ></script>

  <script type="text/javascript">


    $( ".enter-weight" ).keyup(function() {
        var id = $(this).data("id");
        var market = $(this).data("value");
        var gbp = $('.gbp').text();
        var cgp = $('#cgp').val();
        var value =  $('input#input-'+id).val();
        console.log(value);
        var per_gram = (((gbp / 31.104) * market ) * (cgp * 0.01));
        $('span#market-value-'+id).text(value*per_gram);
    });

    $( "#cgp" ).keyup(function() {
      updateTableList();
    });


    $( "#refresh" ).click(function() {
        updateMetalPrices();
        updateTableList();
        $( ".enter-weight" ).val(1);
    });


    function updateMetalPrices(){
      $.ajax({
         type:'GET',
         url:'{{ route("getmetalprices") }}',
         success:function(data) {
            $(".lgold").text(data.lgold);
         }
      });
      console.log('lgold updated!');
    }

    function updateTableList() {
       $('.price').each(function(index, obj){
          var id = $(this).data("id");
          var market = $(this).data("value");
          var gbp = $('.gbp').text();
          var cgp = $('#cgp').val();
          var value =  $('input#input-'+id).val();
          var per_gram = (((gbp / 31.104) * market ) * (cgp * 0.01));
          $(this).text(value*per_gram);
      });
      console.log('table updated!');
    }

  </script>

</body>
</html>