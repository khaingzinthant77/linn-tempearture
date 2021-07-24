@extends('adminlte::page')

@section('title', 'Hostel')

@section('content_header')
<script src="{{ asset('js/jquery-3.4.1.slim.min.js')}}"></script>
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
        <form action="{{route('hostelemployee.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('post')
       <div class="row">
               
        <label class="col-md-2 unicode">Employee Name</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
            <select class="livesearch form-control" name="emp_id"></select>
         
        </div>    
    </div><br>

 <input type="hidden" name="name" class="form-control unicode" id="name" > 
 <input type="hidden" name="branch_id" class="form-control unicode" id="branch" > 
 <input type="hidden" name="dep_id" class="form-control unicode" id="department" > 
 <input type="hidden" name="position_id" class="form-control unicode" id="position" > 
    <div class="row">
               
        <label class="col-md-2 unicode">Hostel Name</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
            <select class="form-control" name="hostel_id" style="font-size: 13px">
                <option value="">select hostel</option>
                @foreach ($hostels as $hostel )
                  <option  value="{{$hostel->id}}">{{$hostel->name}}</option>
                @endforeach
            </select>  
         
        </div>    
    </div><br>
     <div class="row">
               
        <label class="col-md-2 unicode">Full Address</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
           <textarea name="full_address" rows="4" class="form-control unicode" id="full_address" placeholder="Paung Long 4 street,Pyinmana" readonly></textarea>
         
        </div>    
    </div><br>

      <div class="row">
               
        <label class="col-md-2 unicode">Room No</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
            <select class="form-control" name="room_id" style="font-size: 13px">
                <option value="">-</option>
            </select>  
         
        </div>    
    </div><br>

     <div class="row">
               
        <label class="col-md-2 unicode">Start Date</label>
        <div class="col-md-5 {{ $errors->first('name', 'has-error') }}">
            
           <input type="text" name="start_date" class="form-control unicode" id="start_date" > 
         
        </div>    
    </div><br>

        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('hostelemployee.index')}}"> Back</a>
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
<link id="bsdp-css" href="{{ asset('/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
@stop

@section('js')
<script type="text/javascript" src="{{ asset('select2/js/select2.min.js') }}"></script>
<script src="{{ asset('jquery-ui.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
     $(document).ready(function(){

        $("select[name='hostel_id']").change(function() {
        var room_id = $(this).val();
        var token = $("input[name='_token']").val();
        $.ajax({
            url: "<?php echo route('select-ajax-hostel') ?>",
            method: 'POST',
            dataType: 'html',
            data: {
                room_id: room_id,
                _token: token
            },
            success: function(data) {
                $("select[name='room_id']").html(data);
            }
        });
    });

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
                        $("#department").val(data.department_id);
                        $("#branch").val(data.branch_id);
                        $("#name").val(data.employee_name);
                        $("#position").val(data.position_id);

                        console.log(data.name);
                    }
                });
        });
    });


         $(function(){
       $("select[name='hostel_id']").change(function(){
          var is_employee = $(this).find(':selected').val();
          
             $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "<?php echo route('get_department_address') ?>",
                    data: {'emp_id': is_employee},
                    success: function(data){
                        $("#full_address").val(data.full_address);
                        console.log(data.full_address);
                    }
                });
        });
    });

        $("#start_date").datepicker({ dateFormat: 'dd-mm-yy' });

});

</script>
@stop