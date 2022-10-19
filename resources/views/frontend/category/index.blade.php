@extends('layouts.app')
@section('title',"My Expenses category List")
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


    <div class="row mt-5">
        <div class="col-md-8 margin_content" >
            <div class="d-flex justify-content-between" >
                <h3 class="float-start">My category ({{$records->total()}})</h3>
                <button class="btn btn-success float-end  px-3" data-toggle="modal" data-target="#add_category_modal"><i class="fas fa-plus-circle me-2"></i>Add Category</button>
            </div>
            
            <table class="table table-striped table-hover table-bordered m-auto" >
                <thead>
                    <tr>
                        <th scope="col">Sr.</th>
                        <th scope="col">Category</th>
                        <th scope="col">Payment Amount</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($records))

                    @foreach($records as $index=>$data)
                    <tr class="deleteRow">
                        <th scope="row">{{$index+1}}</th>
                        <td>{{$data->category_name}}</td>
                        <td class="m-auto">
                          {{$data->category_icon}}
                      </td>
                      <td class="m-auto">
                        <button class="btn btn-outline-primary modaleditclick" data-toggle="modal" data-target="#edit_category_modal" id="{{$data->id}}" category_name="{{$data->category_name}}" category_icon="{{$data->category_icon}}">
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


<div class="modal fade" id="edit_category_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     {!!Form::open(['url'=>['category-update'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update category</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      
        

      <div class="mb-3">
        <label for="" class="col-form-label">Enter Category</label>
        {!!Form::text('category_name',null,array('class'=>'form-control append_category_name','autocomplete'=>'off','required','placeholder'=>'Enter Category')) !!} 
    </div>

    <input type="hidden" name="id" value="" class="append_id">
    
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text h-100 selected-icon"></span>
        </div>

        {!!Form::text('category_icon',null,array('class'=>'form-control iconpicker','placeholder'=>'Select Category Icons','autocomplete'=>'off','required')) !!} 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
        <script src="{{ asset('public/js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset('public/dist/iconpicker.js')}}"></script>



        <script type="text/javascript">
         $(document).ready(function() {


             (async () => {
                 
                const response = await fetch(@json(url('public/dist/iconsets/bootstrap5.json')))
                const result = await response.json()


                const iconpicker = new Iconpicker(document.querySelector(".iconpicker"), {
                    icons: result,
                    showSelectedIn: document.querySelector(".selected-icon"),
                    searchable: true,
                    selectedClass: "selected",
                    containerClass: "my-picker",
                    hideOnSelect: true,
                    fade: true,
                    defaultValue: 'bi-alarm',
                    valueFormat: val => `bi ${val}`
                });

            iconpicker.set() // Set as empty
            iconpicker.set('bi-alarm') // Reset with a value
        })()
        
    })
</script>




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


<div class="modal fade" id="add_category_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     {!!Form::open(['url'=>['category'],'files' => true, 'class' => ' form-bordered form-row-stripped','id' =>'comman_form_id'])!!}

     <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add category</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      
        

      <div class="mb-3">
        <label for="" class="col-form-label">Enter Category</label>
        {!!Form::text('category_name',null,array('class'=>'form-control','autocomplete'=>'off','required','placeholder'=>'Enter Category')) !!} 
    </div>

    
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text h-100 selected-icon1"></span>
        </div>

        {!!Form::text('category_icon',null,array('class'=>'form-control iconpicker1','placeholder'=>'Select Category Icons','autocomplete'=>'off','required')) !!} 
        

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
        <script src="{{ asset('public/js/jquery-3.3.1.min.js')}}"></script>

        <script src="{{asset('public/dist/iconpicker.js')}}"></script>



        <script type="text/javascript">
         $(document).ready(function() {


             (async () => {
                 
                const response1 = await fetch(@json(url('public/dist/iconsets/bootstrap5.json')))
                const result1 = await response1.json()


                const iconpicker1 = new Iconpicker(document.querySelector(".iconpicker1"), {
                    icons: result1,
                    showSelectedIn: document.querySelector(".selected-icon1"),
                    searchable: true,
                    selectedClass: "selected",
                    containerClass: "my-picker",
                    hideOnSelect: true,
                    fade: true,
                    defaultValue: 'bi-alarm',
                    valueFormat: val => `bi ${val}`
                });

            iconpicker1.set() // Set as empty
            iconpicker1.set('bi-alarm') // Reset with a value
        })()
        
    })
</script>



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


        $(".append_category_name").val('')
        $(".append_category_icon").val('')


        var category_name=$(this).attr('category_name');
        var category_icon=$(this).attr('category_icon');
        var id=$(this).attr('id');

        
        $(".append_id").val(id)

        $(".append_category_name").val(category_name)
        $(".append_category_icon").val(category_icon)



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

         url:baseUrl+'/category/delete',
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


