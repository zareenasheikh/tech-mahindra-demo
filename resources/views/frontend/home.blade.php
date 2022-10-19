@extends('layouts.app')
@section('title',"Tech mahindra job opportunity and code test")
<!-- ................Add meta ................ -->


@section('meta')
@endsection

<!-- ................custom css................. -->

@section('customStyle')

@endsection

<!-- ................Add css link................. -->

@push('style')
@endpush

@section('content')


<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
  }

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}

.justify-content-between{
    margin-bottom: 20px;
}

.table-bordered .m-auto{

margin-top: 30px;
}

.margin_content{

    margin: 0 auto;
}

</style>

<div class="container">
    @include('layouts.header')

    <div class="row  mt-5">
       <div class="col-md-12 margin_content" >
        <div class="d-flex justify-content-between" >
            <h3 class="float-start">Stock Price ({{$records->total()}})</h3>
            <button class="btn btn-success float-end  px-3" data-toggle="modal" data-target="#add_income_modal"><i class="fas fa-plus-circle me-2"></i>Get Price</button>


      {{--         <div class="mb-3">
        <label for="" class="col-form-label">stock symbol</label>
        {!!Form::text('symbol','AMZN',array('class'=>'form-control','placeholder'=>'Enter stock symbol','autocomplete'=>'off','required','id'=>'symbol_id')) !!} 

            <button type="button" class="btn btn-success getPrice">Get Price</button>

    </div> --}}

        </div>
        
        <table class="table table-striped table-hover table-bordered m-auto" >
            <thead>
                <tr>
                    <th scope="col">Sr.</th>
                    <th scope="col">Date</th>
                    <th scope="col">Symbol</th>
                    <th scope="col">Open</th>
                    <th scope="col">High</th>
                    <th scope="col">Low</th>
                    <th scope="col">Price</th>
                    <th scope="col">Volume</th>
                    <th scope="col">Latest trading day</th>
                    <th scope="col">Previous close</th>
                    <th scope="col">Change</th>
                    <th scope="col">Change percent</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
               @if(!empty($records))

               @foreach($records as $index=>$data)
               <tr class="deleteRow">
                <th scope="row">{{$index+1}}</th>
                <td class="m-auto" >{{date('d-m-Y',strtotime($data->craeted_at))}}</td>
                <td class="m-auto" >{{ $data->quote_symbol }}</td>
                 <td class="m-auto" >{{ $data->quote_open }}</td>
                  <td class="m-auto" >{{ $data->quote_high }}</td>
                   <td class="m-auto" >{{ $data->quote_low }}</td>
                    <td class="m-auto" >{{ $data->quote_price }}</td>
                     <td class="m-auto" >{{ $data->quote_volume }}</td>
                      <td class="m-auto" >{{ $data->quote_latest_trading_day }}</td>
                       <td class="m-auto" >{{ $data->quote_previous_close }}</td>
                        <td class="m-auto" >{{ $data->quote_change }}</td>
                         <td class="m-auto" >{{ $data->quote_change_percent }}</td>
             <td class="m-auto">
               
                <button class="btn btn-outline-danger click_disbled" data="{{$data->id}}">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
        @endforeach
        @endif
        
    </tbody>
</table>

</div>
</div>
</div>




<div class="modal fade" id="add_income_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Income</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      
        
   <label for="" class="col-form-label">stock symbol</label>
        {!!Form::text('symbol','AMZN',array('class'=>'form-control','placeholder'=>'Enter stock symbol','autocomplete'=>'off','required','id'=>'symbol_id')) !!} 

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-success" data-dismiss="modal" id="getPrice">Get Price</button>

</div>


</div>
</div>
</div>
@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/validation.js')}}"></script>




<script type="text/javascript">
   $(document).ready(function() {

// alert('getPrice')

    $("#getPrice").click(function(e){

               e.preventDefault();
     
              var id = $(this).data("id");
       var symbol=$("#symbol_id").val();

                 var token = $("meta[name='csrf-token']").attr("content");
           

                     $.ajax(
                     {
        url:'https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol='+symbol+'&apikey=0O18XUJW9P8QVGQJ',
                  type: 'get',
          
                  data: {
                    "_token": token,
                  },
                 dataType: 'html',
                    success: function(data) {
                        console.log('SUCCESS: ', data);
if (data) {
                        var symbol= data['Global Quote']['01. symbol'];
                        var open= data['Global Quote']['02. open'];
                        var high= data['Global Quote']['03. high'];
                        var low= data['Global Quote']['04. low'];
                        var price= data['Global Quote']['05. price'];
                        var volume= data['Global Quote']['06. volume'];
                        var day= data['Global Quote']['07. latest trading day'];
                        var close= data['Global Quote']['08. previous close'];
                        var change= data['Global Quote']['09. change'];
                        var percent= data['Global Quote']['10. change percent'];

function_new(symbol,open,high,low,price,volume,day,close,change,percent);

}

                },
                    error: function(data) {

                        function_new(symbol='AMZN',open='119.0600',high='119.5200',low='114.7900',price='116.3600',volume='65607448',day='2022-10-18',close='113.7900',change='2.5700',percent='2.2585');

                        console.log('ERROR: ', data);
                    },
               });
            });


  })

function function_new(symbol=null,open=null,high=null,low=null,price=null,volume=null,day=null,close=null,change=null,percent=null){

       var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

          $.ajax({
           type:"POST",

           url:"{{url('store_stock_quote')}}",

          data:{_token: CSRF_TOKEN, quote_symbol:symbol, quote_open:open, quote_high:high, quote_low:low, quote_price:price, quote_volume:volume, quote_latest_trading_day:day, quote_previous_close:close, quote_change:change, quote_change_percent:percent},

           dataType:'JSON',


           complete: function(){
     
     window.location.reload();


         }


     });

}


  $(".click_disbled").click(function(){


       var data=$(this).attr('data');
       var clickDisbled = $(this);


       var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
       swal({
          title: 'Are you sure?',
          text: "You want to delete this record! ",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
      },
      function() {
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

          $.ajax({
           type:"POST",

           url:"{{url('stock_quote/delete')}}",
           data:{_token: CSRF_TOKEN, id:data},
           dataType:'JSON',


           complete: function(){
             // window.location.reload();

             clickDisbled.parents('.deleteRow').fadeOut(1500);

             swal(
              'Deleted!',
              'Your record has been deleted.',
              'success'
              );

         }


     });
      });
   });


</script>
@endpush


