@extends('adminlte::page')

@section('title', 'Training Attendance')

@section('content_header')
@stop
@section('content')
 <div class="container" >
        <form action="{{route('training_attendance.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div class="row">
               
        <label class="col-md-2 unicode">Training Name</label>
        <div class="col-md-5">
            
            <select class="form-control" name="training_id" id="training_id">
              <option value="">Training Name</option>
              @foreach ($trainings as $training )
              <option  value="{{$training->id}}">{{$training->name}}</option>
              @endforeach
           </select>
         
        </div>    
        </div><br>

       <div class="row">
               
        <label class="col-md-2 unicode">Employee Name</label>
        <div class="col-md-5">
            
            <select class="livesearch form-control" name="emp_id"></select>
         
        </div>    
        </div><br>

         <div class="row">
               
        <label class="col-md-2 unicode">Attendance Date</label>
        <div class="col-md-5">
            
            <input type="text" name="att_date" id="att_date" class="form-control">
         
        </div>    
        </div><br>

        <div class="row">
               
        <label class="col-md-2 unicode">Status</label>
        <div class="col-md-5">
            
             <select class="form-control" id="status" name="status" style="font-size: 13px">
                <option value="">All</option>  
                <option value="0">Present</option>
                <option value="1">Absent</option>
                
            </select>
         
        </div>    
        </div><br>

         <div class="row">
               
        <label class="col-md-2 unicode">Remark</label>
        <div class="col-md-5">
            
            <input type="text" name="remark" id="remark" class="form-control">
         
        </div>    
        </div><br>

        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('training_attendance.index')}}"> Back</a>
                         <button class="btn btn-success unicode" type="submit" style="font-size: 13px">
                          Save
                    </button>
                    </div>
            </div>


        </form>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('select2/css/select2.min.css') }}"/>

<style type="text/css">
    .select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 35px;
    user-select: none;
    -webkit-user-select: none; }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 30px;
    position: absolute;
    top: 2px;
    right: 0px;
    left: 365px;
    width: 100px; }
</style>

@stop
<link id="bsdp-css" href="{{ asset('css/bootstrap-datepicker3.min.css')}}" rel="stylesheet">
<script src="{{ asset('js/jquery-3.4.1.slim.min.js')}}"></script>
@section('js')
<script type="text/javascript" src="{{ asset('select2/js/select2.min.js') }}"></script>
<script src="{{ asset('jquery-ui.js') }}"></script>
<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
     $(document).ready(function(){
        $(function() {
            $('.livesearch').select2({
            placeholder: 'Employee Name',
            ajax: {
                url: "<?php echo(route("ajax-autocomplete-search")) ?>",
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
        });
        
        $("#att_date").datepicker({ format: 'dd-mm-yyyy' });

});

</script>
@stop