
@extends('adminlte::page')

@section('title', 'Branch')

@section('content_header')

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
  
           <form @if($redirect_route == 0) action="{{route('notice_board.update',$notice_board->id)}}" @else action="{{route('notice_board_update.update',$notice_board->id)}}" @endif method="post" enctype="multipart/form-data" style="padding-top: 10px">
         
        @csrf
        @method('PUT')

         <div class="row">


                 
          <label class="col-md-2 unicode">Title</label>
          <div class="col-md-5 {{ $errors->first('title', 'has-error') }}">
              
               <input type="text" name="title" placeholder="Enter title" class="form-control" style="font-size: 13px" value="{{$notice_board->title}}"> 
           
          </div>    
      </div><br>

        <div class="row">
                   
            <label class="col-md-2 unicode">Description</label>
            <div class="col-md-5 {{ $errors->first('description', 'has-error') }}">
                <textarea class="form-control" id="description" name="description">{{$notice_board->description}}</textarea>
            </div>    
        </div><br>

        

          <div class="row">
               
        <label class="col-md-2 unicode">Publish Date</label>
        <div class="col-md-5">
            
          <input type="text" name="publish_date" placeholder="" class="form-control" style="font-size: 13px" id="publish_date" value="{{date('d-m-Y',strtotime($notice_board->publish_date))}}">
         
        </div>    
               
        </div><br>

         <div class="row">
              <label class="col-md-2">Notice Type</label>
              <div class="col-md-5">
                   <select class="form-control" id="notice_type" name="notice_type">
                     <option value="">Select Notice Type</option>
                     <option value="1" {{old('notice_type',$notice_board->notice_type == 1 ? 'Selected' :'')}}>All</option>
                     <option value="2" {{old('notice_type',$notice_board->notice_type == 2 ? 'Selected' :'')}}>Rank</option>
                     <option value="3" {{old('notice_type',$notice_board->notice_type == 3 ? 'Selected' :'')}}>Department</option>
                     <option value="4" {{old('notice_type',$notice_board->notice_type == 4 ? 'Selected' :'')}}>Branch</option>
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
              <?php
              $trim_photo = trim($notice_board->image, '[ ] ');
              $photo = explode(',', $trim_photo);

              // dd($photo);
              ?>
              

                  @if ($notice_board->image == '[]')
                       <img src="{{ asset('uploads/images/download.png') }}" alt="photo" width="80px" height="80px">
                  @else
                      @foreach ($photo as $image)
                          <?php $trim_image = trim($image, '"'); ?>
                          <div class="col-md-3">
                              <img src="{{ asset('uploads/postPhoto/' . $trim_image) }}" alt="image"
                                  width="200px">
                          </div>

                          <br>
                      @endforeach
                  @endif

             
          </div>
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
    var val = $('#notice_type').val();

            if(val == '1'){
              $("#rank").hide();
              $("#break_rank").hide();
              $('#branch').hide();
              $('#break_branch').hide();
              $('#department').hide();
              $('#dept_break').hide();
            }
            else if (val == '2') {

              $("#rank").show();
              $("#break_rank").show();
              $('#branch').hide();
              $('#break_branch').hide();
              $('#department').hide();
              $('#dept_break').hide();
            }else if(val == '3'){

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
      $(document).ready(function() {
        // $("#rank").hide();
        // $("#break_rank").hide();
        // $('#branch').hide();
        // $('#break_branch').hide();
        // $('#department').hide();
        // $('#dept_break').hide();
        $('#notice_type').on('change',function(){
            var val = $('#notice_type option:selected').val();
            if(val == '1'){
              $("#rank").hide();
              $("#break_rank").hide();
              $('#branch').hide();
              $('#break_branch').hide();
              $('#department').hide();
              $('#dept_break').hide();
            }
            else if (val == '2') {
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