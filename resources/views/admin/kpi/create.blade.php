@extends('adminlte::page')
@section('title', 'KPI Create')
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
   left: 270px;
   width: 100px; }
</style>
@stop
@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif
<form action="{{route('kpi.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
   @csrf
   @method('post')
   <div class="row">
      <div class="col-md-6">
         <div class="row form-group">
            <div class="col-md-3">
               <label>Department</label>
            </div>
            <div class="col-md-6">
              <select class="form-control" name="dep_id" id="dep_id" style="font-size: 13px">
                  <option value="">Select Department</option>
                  @foreach ($departments as $department )
                    <option  value="{{$department->id}}">{{$department->name}}</option>
                  @endforeach
              </select> 
            </div>
         </div>
          <div class="row form-group">
            <div class="col-md-3">
               <label>Employee Name</label>
            </div>
            <div class="col-md-6">
               <select class="livesearch form-control" name="emp_id"></select>
            </div>
         </div>
         <div class="row form-group">
            <div class="col-md-3">
               <label>Pay Month</label>
            </div>
            <div class="col-md-6">
               <input type="month" name="date" class="form-control unicode" placeholder="" > 
            </div>
         </div>
         <div class="row form-group">
            <div class="col-md-3">
               <label>Comment</label>
            </div>
            <div class="col-md-6">
               <textarea name="comment" id=""class="form-control unicode">{{ old('comment') }}</textarea> 
            </div>
         </div>
      </div>
      <div class="col-md-6">
         <div class="row form-group">
            <div class="col-md-3">
               <label>Knowledge</label>
            </div>
            <div class="col-md-6">
               <select class="form-control" name="knowledge" id="knowledge">
                  <option value="">--Select Point--</option>
                  <option value="1">Poor</option>
                  <option value="2">Bad</option>
                  <option value="3">Average</option>
                  <option value="4">Good</option>
                  <option value="5">Excellent</option>
               </select>
            </div>
         </div>
         <div class="row form-group">
            <div class="col-md-3">
               <label>Discipline</label>
            </div>
            <div class="col-md-6">
               <select  class="form-control" name="discipline" id="discipline">
                  <option value="">--Select Point--</option>
                  <option value="1">Poor</option>
                  <option value="2">Bad</option>
                  <option value="3">Average</option>
                  <option value="4">Good</option>
                  <option value="5">Excellent</option>
               </select>
            </div>
         </div>
         <div class="row form-group">
            <div class="col-md-3">
               <label>Skill Set</label>
            </div>
            <div class="col-md-6">
               <select class="form-control" name="skill_set" id="skill_set">
                  <option value="">--Select Point--</option>
                  <option value="1">Poor</option>
                  <option value="2">Bad</option>
                  <option value="3">Average</option>
                  <option value="4">Good</option>
                  <option value="5">Excellent</option>
               </select>
            </div>
         </div>
         <div class="row form-group">
            <div class="col-md-3">
               <label>Team Work</label>
            </div>
            <div class="col-md-6">
               <select class="form-control" name="team_work" id="team_work">
                  <option value="">--Select Point--</option>
                  <option value="1">Poor</option>
                  <option value="2">Bad</option>
                  <option value="3">Average</option>
                  <option value="4">Good</option>
                  <option value="5">Excellent</option>
               </select>
            </div>
         </div>
         <div class="row form-group">
            <div class="col-md-3">
               <label>Social</label>
            </div>
            <div class="col-md-6">
               <select class="form-control" name="social" id="social">
                  <option value="">--Select Point--</option>
                  <option value="1">Poor</option>
                  <option value="2">Bad</option>
                  <option value="3">Average</option>
                  <option value="4">Good</option>
                  <option value="5">Excellent</option>
               </select>
            </div>
         </div>
         <div class="row form-group">
            <div class="col-md-3">
               <label>Motivation</label>
            </div>
            <div class="col-md-6">
               <select class="form-control" name="motivation" id="motivation">
                  <option value="">--Select Point--</option>
                  <option value="1">Poor</option>
                  <option value="2">Bad</option>
                  <option value="3">Average</option>
                  <option value="4">Good</option>
                  <option value="5">Excellent</option>
               </select>
            </div>
         </div>
      </div>
   </div>
   <div class="row form-group">
      <div class="col-md-12 text-center">
         <a class="btn btn-primary unicode" href="{{route('kpi.index')}}"> Back</a>
         <button type="submit" class="btn btn-success unicode" onClick="javascript:p=true;" style="height: 34px;font-size: 13px">Save</button>
      </div>
   </div>
   <br>
   </div>
</form>
@stop 
@section('css')
<link rel="stylesheet" href="{{ asset('select2/css/select2.min.css') }}"/>
@stop
@section('js')
<script type="text/javascript" src="{{ asset('select2/js/select2.min.js') }}"></script>
<script src="{{ asset('jquery-ui.js') }}"></script>
<script type="text/javascript">
   $(document).ready(function(){
      $("#date").datepicker({ dateFormat: 'dd-mm-yy' });

      var branch_id = '';
      var dep_id ='';
      $("#dep_id").change(function(){
          dep_id = $(this).val();
          getEmployee(branch_id,dep_id);
      });
   });

   function getEmployee(branch_id,dep_id){
        var url = "<?php echo(route("ajax-get-emp-group")) ?>";
        var fullurl = url + '?branch_id='+branch_id+"&dep_id="+dep_id;
        $('.livesearch').select2({
            placeholder: 'Select Employees',
            ajax: {
                url: fullurl,
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
    }
 
</script>
@stop
