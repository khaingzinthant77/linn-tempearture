@extends('adminlte::page')

@section('title', 'Training')

@section('content_header')
@stop
@section('content')
 <div class="container" >
        <form action="{{route('training.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('post')
    <div class="row">
               
        <label class="col-md-2 unicode">Name</label>
        <div class="col-md-5">
            
            <input type="text" name="name" id="name" class="form-control">
         
        </div>    
    </div><br>

     <div class="row">
               
        <label class="col-md-2 unicode">Description</label>
        <div class="col-md-5">
            
            <input type="text" name="description" id="description" class="form-control">
         
        </div>    
    </div><br>

    <div class="row">
               
        <label class="col-md-2 unicode">Peroid </label>
        <div class="col-md-5">
            
            <input type="text" name="peroid" id="Peroid " class="form-control">
         
        </div>    
    </div><br>

   <div class="row">
               
        <label class="col-md-2 unicode">Start Date</label>
        <div class="col-md-5">
            
            <input type="text" name="start_date" id="start_date" class="form-control">
         
        </div>    
    </div><br>

    <div class="row">
               
        <label class="col-md-2 unicode">End Date</label>
        <div class="col-md-5">
            
            <input type="text" name="end_date" id="end_date" class="form-control">
         
        </div>    
    </div><br>

    <div class="row">
               
        <label class="col-md-2 unicode">Trainer name</label>
        <div class="col-md-5">
            
            <input type="text" name="trainer_name" id="trainer_name" class="form-control">
         
        </div>    
    </div><br>

     <div class="row">
               
        <label class="col-md-2 unicode">Trainer info </label>
        <div class="col-md-5">
            
            <input type="text" name="trainer_info" id="trainer_info " class="form-control">
         
        </div>    
    </div><br>

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-5">
            <a class="btn btn-primary unicode" href="{{route('training.index')}}"> Back</a>
             <button class="btn btn-success unicode" type="submit" style="font-size: 13px">
              Save
        </button>
        </div>
    </div>

</form>
</div>
@stop

@section('css')

<link id="bsdp-css" href="{{ asset('css/bootstrap-datepicker3.min.css')}}" rel="stylesheet">
@stop

@section('js')
<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>

<script type="text/javascript">
     $(document).ready(function(){

        $("#start_date").datepicker({ format: 'dd-mm-yyyy' });
        $("#end_date").datepicker({ format: 'dd-mm-yyyy' });
});

</script>
@stop