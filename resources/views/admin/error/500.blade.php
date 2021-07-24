@extends('adminlte::page')

@section('title', __('500'))

@section('content_header')
<div class="row">

</div>
  
@stop

@section('content')
 <div class="container py-5">
      <div class="row">
           <div class="col-md-2 text-center">
                <p><i class="fa fa-exclamation-triangle fa-5x"></i><br/><h3>500</h3></p>
           </div>
           <div class="col-md-10">
                <h3>OPPSSS!!!! Sorry...</h3>
                <p>Sorry, Internal Server Error : 500.Please Contact to your IT Administrator.<br/>Please go back to the previous page to continue browsing.</p>
                <a class="btn btn-danger" href="javascript:history.back()">Go Back</a>
           </div>
      </div>
 </div>
@stop


@section('css')
 
@stop

@section('js')
  
@stop