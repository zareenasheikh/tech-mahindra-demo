@extends('layouts.app')
@section('title',"My Monthly Expense List")
<!-- ................Add meta ................ -->


@section('meta')
@endsection

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
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
@endsection

<!-- ................Add css link................. -->

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

@endpush

@section('content')

<div class="container">
    @include('layouts.header')

    <div class="row  mt-5">
       <div class="col-md-8 margin_content" >
        <div class="d-flex justify-content-between" >
            <h3 class="float-start">My Expense ({{$records->total()}})</h3>
        </div>
        
        <table class="table table-striped table-hover table-bordered m-auto" >
            <thead>
                <tr>
                    <th scope="col">Sr.</th>
                    <th scope="col">Expense Date</th>
                    <th scope="col">Expense Category</th>
                    <th scope="col">Expense Amount</th>
                </tr>
            </thead>
            <tbody>
               @if(!empty($records))

               @foreach($records as $index=>$data)
               <tr class="deleteRow">
                <th scope="row">{{$index+1}}</th>
                <td>{{date('d-M-Y',strtotime($data->expense_date))}}</td>
                <td> <i class="{{$data->category->category_icon}} text-success" aria-hidden="true"></i>   {{$data->category->category_name}}</td>
                <td class="m-auto">
                 ₹ {{$data->expense_amount}}
             </td>
             
         </tr>
         @endforeach
         @endif
         
     </tbody>
 </table>

</div>
</div>
</div>


@endsection

<!-- ................push new js link................. -->

@push('js')


@endpush


