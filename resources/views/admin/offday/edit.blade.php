@extends('adminlte::page')

@section('title', 'Offday')

@section('content_header')
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
@section('content')
 <div class="container" >
        <form action="{{route('offday.update',$offdays->id)}}" method="post" enctype="multipart/form-data">
       @csrf
        @method('PUT')
       <div class="row">
               
        <label class="col-md-2 unicode">Employee Name</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
            <select class="livesearch form-control" name="emp_id">
                @foreach ($employees as $employee )
                  <option  value="{{$employee->id}}" {{ (old('emp_id',$offdays->emp_id)==$employee->id)?'selected':'' }}>{{$employee->name}}</option>
                @endforeach
            </select>
         
        </div>    
        </div><br>

        <div class="row">
               
        <label class="col-md-2 unicode">Off_day_1</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
           <input type="date" name="off_day_1" class="form-control" placeholder="01-01-2021" id="off_day_1" value="{{$offdays->off_day_1}}">
         
        </div>    
        </div><br>

         <div class="row">
               
        <label class="col-md-2 unicode">Off_day_2</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
           <input type="date" name="off_day_2" class="form-control" placeholder="01-01-2021" id="off_day_2" value="{{$offdays->off_day_2}}">
         
        </div>    
        </div><br>

        <div class="row">
               
        <label class="col-md-2 unicode">Off_day_3</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
           <input type="date" name="off_day_3" class="form-control" placeholder="01-01-2021" id="off_day_3" value="{{$offdays->off_day_3}}">
         
        </div>    
        </div><br>

        <div class="row">
               
        <label class="col-md-2 unicode">Off_day_4</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
           <input type="date" name="off_day_4" class="form-control" placeholder="01-01-2021" id="off_day_4" value="{{$offdays->off_day_3}}">
         
        </div>    
        </div><br>
     

        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('offday.index')}}"> Back</a>
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
<link id="bsdp-css" href="{{ asset('css/bootstrap-datepicker3.min.css')}}" rel="stylesheet">

@stop

<script src="{{ asset('js/jquery-3.4.1.slim.min.js')}}"></script>
@section('js')
<script type="text/javascript" src="{{ asset('select2/js/select2.min.js') }}"></script>
<script src="{{ asset('jquery-ui.js') }}"></script>
<script src="{{ asset('/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
     $(document).ready(function(){
        $("#half_day").hide();
        $("#break").hide();
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

         $(function(){
        $('.livesearch').change(function(){
          var is_employee = $(this).find(':selected').val();
          // alert(is_employee);
            // alert(is_employee);$('#first').find(':selected').val();
             $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "<?php echo route('get_hostelemployee_data') ?>",
                    data: {'emp_id': is_employee},
                    success: function(data){
                        // console.log(data.branch_id);
                        $("#department").val(data.department_id);
                        $("#branch").val(data.branch_id);
                        $("#name").val(data.employee_name);
                        $("#position").val(data.position_id);

                        console.log(data.name);
                    }
                });
        });
    });
  
        // $("#off_day_1").datepicker({ dateFormat: 'dd-mm-yy' });
        // $("#off_day_2").datepicker({ dateFormat: 'dd-mm-yy' });
        // $("#off_day_3").datepicker({ dateFormat: 'dd-mm-yy' });
        // $("#off_day_4").datepicker({ dateFormat: 'dd-mm-yy' });
        

});

</script>
@stop