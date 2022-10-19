@extends('layouts.app')
@section('title',"My Monthly Income List")
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
       <div class="col-md-8 margin_content" >
        <div class="d-flex justify-content-between" >
            <h3 class="float-start">My Income ({{$records->total()}})</h3>
            <button class="btn btn-success float-end  px-3" data-toggle="modal" data-target="#add_income_modal"><i class="fas fa-plus-circle me-2"></i>Add Income</button>
        </div>
        
        <table class="table table-striped table-hover table-bordered m-auto" >
            <thead>
                <tr>
                    <th scope="col">Sr.</th>
                    <th scope="col">Payment Date</th>
                    <th scope="col">Payment Amount</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
               @if(!empty($records))

               @foreach($records as $index=>$data)
               <tr class="deleteRow">
                <th scope="row">{{$index+1}}</th>
                <td>{{date('d-m-Y',strtotime($data->date))}}</td>
                <td class="m-auto">
                 ₹ {{$data->amount}}
             </td>
             <td class="m-auto">
                <button class="btn btn-outline-primary modaleditclick" data-toggle="modal" data-target="#edit_income_modal" id="{{$data->id}}" date="{{$data->date}}" amount="{{$data->amount}}">
                    <i class="far fa-edit"></i>
                </button>
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


<div class="modal fade" id="edit_income_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      {!!Form::open(['url'=>['income-update'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Income</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      
        

      <div class="mb-3">
        <label for="" class="col-form-label">Select Payment Date</label>
        {!!Form::date('date',null,array('class'=>'form-control append_date','autocomplete'=>'off','required')) !!} 
    </div>

    <input type="hidden" name="id" value="" class="append_id">
    <div class="mb-3">
        <label for="" class="col-form-label">Payment Amount</label>
        {!!Form::number('amount',null,array('class'=>'form-control append_amount','placeholder'=>'Enter Amount','autocomplete'=>'off','required')) !!} 
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-success">Save</button>

</div>

{{Form::close()}}


</div>
</div>
</div>


<div class="modal fade" id="add_income_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      {!!Form::open(['url'=>['income'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Income</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      
        

      <div class="mb-3">
        <label for="" class="col-form-label">Select Payment Date</label>
        {!!Form::date('date',null,array('class'=>'form-control','autocomplete'=>'off','required')) !!} 
    </div>

    <div class="mb-3">
        <label for="" class="col-form-label">Payment Amount</label>
        {!!Form::number('amount',null,array('class'=>'form-control','placeholder'=>'Enter Amount','autocomplete'=>'off','required')) !!} 
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-success">Update</button>

</div>

{{Form::close()}}


</div>
</div>
</div>
@endsection

<!-- ................push new js link................. -->

@push('js')
<script src="{{asset('public/js/validation.js')}}"></script>


<script type="text/javascript">
   $(document).ready(function() {

      $('.modaleditclick').on('click', function(e) {


        $(".append_date").val('')
        $(".append_amount").val('')


        var date=$(this).attr('date');
        var amount=$(this).attr('amount');
        var id=$(this).attr('id');

        
        $(".append_id").val(id)

        $(".append_date").val(date)
        $(".append_amount").val(amount)



    })


  })


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

           url:baseUrl+'/income/delete',
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


