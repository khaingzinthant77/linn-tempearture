
@extends('adminlte::page')

@section('title', 'Branch')

@section('content_header')
<link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">
<style type="text/css">
    #selectedFiles img {
            max-width: 200px;
            max-height: 200px;
            float: left;
            margin-bottom:10px;
        }
        #userActions input{
            width: auto;
            margin: auto;
        }
        #selectFiles img {
            max-width: 200px;
            max-height: 200px;
            float: left;
            margin-bottom:10px;
        }
</style>
@stop
@section('content')
 <div class="container" style="margin-top: 50px; ">
         <form action="{{route('notice_board.store')}}" method="post" enctype="multipart/form-data" style="padding-top: 10px">
        @csrf

         <div class="row">
                 
          <label class="col-md-2 unicode">Title</label>
          <div class="col-md-5 {{ $errors->first('title', 'has-error') }}">
              
               <input type="text" name="title" placeholder="Enter title" class="form-control" style="font-size: 13px"> 
           
          </div>    
      </div><br>

        <div class="row">
                   
            <label class="col-md-2 unicode">Description</label>
            <div class="col-md-5 {{ $errors->first('description', 'has-error') }}">
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>    
        </div><br>

         

          <div class="row">
               
        <label class="col-md-2 unicode">Publish Date</label>
        <div class="col-md-5">
            
          <input type="text" name="publish_date" placeholder="" class="form-control" style="font-size: 13px" id="publish_date" value="{{date('d-m-Y')}}">
         
        </div>    
               
        </div><br>

         <div class="row">
              <label class="col-md-2">Notice Type</label>
              <div class="col-md-5">
                   <select class="form-control" id="notice_type" name="notice_type">
                     <option value="">Select Notice Type</option>
                     <option value="1">All</option>
                     <option value="2">Rank</option>
                     <option value="3">Department</option>
                     <option value="4">Branch</option>
                   </select>
              </div>
            </div><br>
          <div class="row" id="rank">
            <label class="col-md-2">Rank</label>
              <div class="col-md-5">
                   <select class="form-control" id="rank" name="rank">
                     <option value="">Select Rank</option>
                     @foreach($positions as $position)
                      <option value="{{$position->id}}">{{$position->name}}</option>
                     @endforeach
                   </select>
              </div>
          </div><br id="break_rank">
          <div class="row" id="department">
            <label class="col-md-2">Department</label>
              <div class="col-md-5">
                   <select class="form-control" id="department" name="department">
                     <option value="">Select Department</option>
                     @foreach($departments as $department)
                      <option value="{{$department->id}}">{{$department->name}}</option>
                     @endforeach
                   </select>
              </div>
          </div><br id="dept_break">
          <div class="row" id="branch">
            <label class="col-md-2">Branch</label>
              <div class="col-md-5">
                   <select class="form-control" id="branch" name="branch">
                     <option value="">Select Branch</option>
                     @foreach($branches as $branch)
                      <option value="{{$branch->id}}">{{$branch->name}}</option>
                     @endforeach
                   </select>
              </div>
          </div><br id="break_branch">
            <div class="row">
                 
              <label class="col-md-2 unicode">Photo</label>
              <div class="col-md-5">
                <input type="file" id="filename" name="filename[]" multiple>
              </div>  
          <div id="selectedFiles"></div>
                 
          </div><br>
        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('notice_board.index')}}"> Back</a>
                        <button class="btn btn-success" type="submit" style="font-size: 13px">
                    Save
                     </button>
                    </div>
            </div>

        </form>
    </div>
@stop 
@section('css')
<link id="bsdp-css" href="{{ asset('/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
@stop



@section('js')
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>

  <script type="text/javascript">
    $("#publish_date").datepicker({ format: 'dd-mm-yyyy' });
      $(document).ready(function() {
        $("#rank").hide();
        $("#break_rank").hide();
        $('#branch').hide();
        $('#break_branch').hide();
        $('#department').hide();
        $('#dept_break').hide();
        $('#notice_type').on('change',function(){
            var val = $('#notice_type option:selected').val();
            if (val == '2') {
              $("#rank").show();
              $("#break_rank").show();
              $('#branch').hide();
              $('#break_branch').hide();
              $('#department').hide();
              $('#dept_break').hide();
            }else if(val == "3"){
              $('#department').show();
              $('#dept_break').show();
              $("#rank").hide();
              $("#break_rank").hide();
              $('#branch').hide();
              $('#break_branch').hide();
            }else if(val == '4'){
               $('#branch').show();
              $('#break_branch').show();
              $("#rank").hide();
              $("#break_rank").hide();
              $('#department').hide();
              $('#dept_break').hide();
            }
        });

   });
     
  </script>
@stop