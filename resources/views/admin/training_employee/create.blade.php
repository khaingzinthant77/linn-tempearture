@extends('adminlte::page')

@section('title', 'Training Employee')

@section('content_header')
@stop
@section('content')
 <div class="container" >
        <form action="{{route('training_emp.store')}}" method="post" enctype="multipart/form-data">
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
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('training_emp.index')}}"> Back</a>
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

<script src="{{ asset('js/jquery-3.4.1.slim.min.js')}}"></script>
@section('js')
<script type="text/javascript" src="{{ asset('select2/js/select2.min.js') }}"></script>
<script src="{{ asset('jquery-ui.js') }}"></script>
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
        
        

});

</script>
@stop