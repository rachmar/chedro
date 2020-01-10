<!DOCTYPE html>
<html>
<head>
    @include('partials._header')
    

</head>

<body class="skin-blue layout-top-nav ">

  <div id="app">

    <div class="wrapper">


      <div class="content-wrapper">

        <div class="container">

          <section class="content">

            <div class="row">

  <div class="row">

    
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Control # : {{ strtoupper($transaction->control_id) }}</h3>

          <div class="pull-right" >
                @if ( $transaction->priority_id === 1 )
               <span class="label  bg-green">Lease Priority</span>
            @elseif ( $transaction->priority_id === 2 )
               <span class="label  bg-yellow">Mid Priority</span>
            @elseif ( $transaction->priority_id === 3 )
               <span class="label  bg-red">High Priority</span>
            @else
               <span class="label  bg-blue">No Priority Set</span>
            @endif
          </div>

          <div class="pull-right" style="margin-right: 10px;">
            <span class="label bg-maroon">{{$transaction->status_name}}</span>
          </div>

            </div>

             <div class="box-body">
                

                <div class="row">
                   
                   <div class="form-group col-md-6">
                      <label for="uploadFile">Institution Name</label>
                      <p>{{ $transaction->institution_name }}</p>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="uploadFile">Document Name</label>
                      <p>{{ $transaction->document_name }}</p>
                    </div>

                    <div class="form-group col-md-12">
                      <label for="uploadFile">Subject</label>
                      <p>{{ $transaction->subject }}</p>
                    </div>

                    <div class="form-group col-md-12">
                      <label for="uploadFile">Comments</label>
                      <div>
                      @if ( !$comments->isEmpty() )
                      @foreach($comments as $comment)
                          <dl>
                    <dt>{{ $comment->user }} @ {{ $comment->created_at->format('h:i a') }}</b></dt>
                    <dd>{{ $comment->message }}</dd>
                  </dl>
                      @endforeach
                      @else 
                        No Comments Found 
                      @endif
                      </div>
                    </div>


                   <div class="form-group col-md-12">
                      <label for="uploadFile">Attachment</label>
                      <div>
                      @if ( !$attachments->isEmpty() )
                      @foreach($attachments as $attachment)
                          <a href="{{asset('storage/'.$attachment->image_filename)}}" target="_blank"> {{ $attachment->image_filename }} </a>
                           <br/>
                      @endforeach
                      @else 
                        No Attachments Found 
                      @endif
                      </div>
                    </div>

                    

                  </div>

              </div>




              <div class="box-footer text-center">
                  <a href="{{ route('search.index') }}" class="uppercase">Go Back</a>
                </div>

          </div>
      </div>



      

    </div>

   

</div>

          </section>

        </div>
        

      </div>


    </div>

  </div>



  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" ></script>


</body>
</html>
