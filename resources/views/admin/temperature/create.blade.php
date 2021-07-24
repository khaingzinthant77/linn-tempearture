@extends('adminlte::page')

@section('title', 'Temperature')

@section('content_header')
<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/base/jquery-ui.css" rel="stylesheet" />


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
    /*left: 270px;*/
    width: 100px; }
</style>
@stop

@section('content')
 
    <!-- <div class="row">
        <div class="col-lg-11">
            <a class="btn btn-success unicode" href="{{route('employee.index')}}"> Back</a>
        </div>
    </div><br> -->
  <form action="{{route('temperature.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div class="row form-group">
            <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label style="font-weight:bold;font-size:15px;">Employee Name</label>
                                </div>

                                <div class="col-md-8">
                                     <select class="livesearch form-control" name="emp_id"></select>

                                    


                                </div>
                            </div>
              </div>
        </div>

        
         

        <div class="row form-group">
            <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label style="font-weight:bold;font-size:15px;">Department</label>
                                </div>

                                <div class="col-md-8">

                                       <input type="text" name="department" class="form-control unicode" id="department" > 

                                </div>
                            </div>
              </div>
        </div>

        <div class="row form-group">
            <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label style="font-weight:bold;font-size:15px;">Branch</label>
                                </div>

                                <div class="col-md-8">

                                       <input type="text" name="branch" class="form-control unicode" id="branch" > 

                                </div>
                            </div>
              </div>
        </div>

         <div class="row form-group">
            <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label style="font-weight:bold;font-size:15px;">Temperature Date</label>
                                </div>

                                <div class="col-md-8">

                                    <input type="text" name="date" class="form-control" placeholder="01-01-2021" id="date">

                                </div>
                            </div>
              </div>
        </div>

         <div class="row form-group">
            <div class="col-md-6">
                            <div class="row salary">
                                <div class="col-md-3">
                                    <label style="font-weight:bold;font-size:15px;">Temperature</label>
                                </div>

                                <div class="col-md-8">

                                    <input type="text" name="temperture_no" class="form-control unicode"> 

                                </div>
                            </div>
              </div>
        </div>


         <div class="row form-group">
            <div class="col-md-6">
                            <div class="row salary">
                                <!-- <div class="col-md-3">
                                    <label style="font-weight:bold;font-size:15px;">Remark</label>
                                </div> -->

                                <div class="col-md-8">

                                    <input type="hidden" name="remark" class="form-control unicode"> 

                                </div>
                            </div>
              </div>
        </div>

       

        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('temperature.index')}}"> Back</a>
                        <button type="submit" class="btn btn-success unicode" onClick="javascript:p=true;" style="height: 34px;font-size: 13px">Save</button>
                    </div>
            </div><br>
             
                        
        </div>
  </form>
@stop 



@section('css')
<link rel="stylesheet" href="{{ asset('select2/css/select2.min.css') }}"/>
@stop



@section('js')
<script type="text/javascript" src="{{ asset('select2/js/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('jquery-ui.js') }}"></script>
<script type="text/javascript">

    $(document).ready(function(){
          $("#date").datepicker({ dateFormat: 'dd-mm-yy' });
    });
    $(function() {
            $('.livesearch').select2({
            placeholder: 'Employee Name',
            ajax: {
                url: "<?php echo(route("ajax-autocomplete-temperature")) ?>",
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
                    url: "<?php echo route('get_department_data') ?>",
                    data: {'emp_id': is_employee},
                    success: function(data){
                        $("#department").val(data.name);
                        $("#branch").val(data.branch_name);
                        $("#name").val(data.employee_name);
                        // console.log(data.branch_name);
                    }
                });
        });
    });

    $(document).on("change",".salary", function (e) {
         var salary = $("#salary").val();
         var bonus = $("#bonus").val();
         var total =  parseInt(salary) +  parseInt(bonus);
         dd(total);
          $("#month_total").val(total);
    });

    $(document).on("change",".ctr_item_option", function (e) {

        var is_employee =$(this).find(':selected').attr('data_is_employee');
        // alert(is_employee);
         $.ajax({
                type: "GET",
                dataType: "json",
                url: "<?php echo route('get_department_data') ?>",
                data: {'emp_id': is_employee},
                success: function(data){
                    $("#department").val(data.name);
                    $("#branch").val(data.branch_name);
                    $("#name").val(data.employee_name);
                    // console.log(data.name);
                }
            });
    
    });


</script>
@stop