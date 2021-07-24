@extends('adminlte::page')

@section('title', 'Test Result')

@section('content_header')
@stop
@section('content')
 <div class="container" >
        <form action="{{route('test_result.update',$test_result->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
               
        <label class="col-md-2 unicode">Training Name</label>
        <div class="col-md-5">
            
            <select class="form-control" name="training_id" id="training_id">
               <option value="">Training Name</option>
              @foreach ($trainings as $training )
              <option  value="{{$training->id}}" {{ (old('training_id',$test_result->training_id)==$training->id)?'selected':'' }}>{{$training->name}}</option>
              @endforeach
           </select>
         
        </div>    
        </div><br>

       <div class="row">
               
        <label class="col-md-2 unicode">Employee Name</label>
        <div class="col-md-5">
            
            <select class="livesearch form-control" name="emp_id">
                 @foreach ($employees as $employee )
                  <option  value="{{$employee->id}}" {{ (old('emp_id',$test_result->emp_id)==$employee->id)?'selected':'' }}>{{$employee->name}}</option>
                @endforeach
            </select>
         
        </div>    
        </div><br>

         <div class="row">
               
        <label class="col-md-2 unicode">Test Date</label>
        <div class="col-md-5">
            
            <input type="text" name="test_date" id="test_date" class="form-control" value="{{date('d-m-Y',strtotime($test_result->test_date))}}">
         
        </div>    
        </div><br>

         <div class="row">
               
        <label class="col-md-2 unicode">Mark</label>
        <div class="col-md-5">
            
            <input type="text" name="marks" id="marks" class="form-control" value="{{$test_result->marks}}">
         
        </div>    
        </div><br>
       

         <div class="row">
               
        <label class="col-md-2 unicode">Remark</label>
        <div class="col-md-5">
            
            <input type="text" name="remark" id="remark" class="form-control" value="{{$test_result->remark}}">
         
        </div>    
        </div><br>

        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('test_result.index')}}"> Back</a>
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
        
        $("#test_date").datepicker({ format: 'dd-mm-yyyy' });

});

</script>
@stop