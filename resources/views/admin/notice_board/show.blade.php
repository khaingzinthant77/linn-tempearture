
@extends('adminlte::page')

@section('title', 'Branch')

@section('content_header')

@stop
@section('content')
<div class="row">
    <div class="col-lg-10">
           @if($back_route == 1)
         <a class="btn btn-success unicode" href="{{route('dashboard')}}"> Back</a>
         @else
         <a class="btn btn-success unicode" href="{{route('notice_board.index')}}"> Back</a>
         @endif
    </div>
    <div class="col-lg-2">
        <div class="pull-right">
          <form action="{{route('notice_board_delete',$notice_boards->id)}}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                            @csrf
                            @method('DELETE')
                            
                              <a class="btn btn-sm btn-primary" href="{{route('notice_board_edit',$notice_boards->id)}}"><i class="fa fa-fw fa-edit" /></i></a>
                           
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash" /></i></button> 
          </form>
        </div>
    </div>
</div><br>
 <div class="container" style="margin-top: 50px; ">
         <form action="{{route('notice_board.store')}}" method="post" enctype="multipart/form-data" style="padding-top: 10px">
        @csrf

         <div class="row">
                 
          <label class="col-md-2 unicode">Title</label>
          <div class="col-md-5 {{ $errors->first('title', 'has-error') }}">
              
               <input type="text" name="title" placeholder="Enter title" class="form-control" style="font-size: 13px" value="{{$notice_boards->title}}" readonly="readonly"> 
           
          </div>    
      </div><br>

        <div class="row">
                   
            <label class="col-md-2 unicode">Description</label>
            <div class="col-md-5 {{ $errors->first('description', 'has-error') }}">
                <textarea class="form-control" id="description" name="description" readonly="readonly">{{$notice_boards->description}}</textarea>
            </div>    
        </div><br>


          <div class="row">
               
        <label class="col-md-2 unicode">Publish Date</label>
        <div class="col-md-5">
            
          <input type="text" name="publish_date" placeholder="" class="form-control" style="font-size: 13px" id="publish_date" value="{{date('d-m-Y',strtotime($notice_boards->publish_date))}}" readonly="readonly">
         
        </div>    
               
        </div><br>

         <div class="row">

              <label class="col-md-2">Notice Type</label>
              <div class="col-md-5">
                @if($notice_boards->notice_type == 1)
                   <input type="text" name="" class="form-control" value="All" readonly="readonly">
                @elseif($notice_boards->notice_type == 2)
                    <input type="text" name="" class="form-control" value="Rank" readonly="readonly">
                @elseif($notice_boards->notice_type == 3)
                    <input type="text" name="" class="form-control" value="Department" readonly="readonly">
                @elseif($notice_boards->notice_type == 4)
                    <input type="text" name="" class="form-control" value="Branch" readonly="readonly">
                @endif
              </div>
            </div><br>
          <div class="row" id="rank">
            @if($notice_boards->notice_type == '2')
            <label class="col-md-2">Rank</label>
            @elseif($notice_boards->notice_type == '3')
            <label class="col-md-2">Department</label>
            @elseif($notice_boards->notice_type == '4')
            <label class="col-md-2">Branch</label>
            @endif
              <div class="col-md-5">
                @if($notice_boards->notice_type == 2)
                    <input type="text" name="" class="form-control" value="{{$notice_boards->position->name}}" readonly="readonly">
                @elseif($notice_boards->notice_type == 3)
                    <input type="text" name="" class="form-control" value="{{$notice_boards->department->name}}" readonly="readonly">
                @elseif($notice_boards->notice_type == 4)
                    <input type="text" name="" class="form-control" value="{{$notice_boards->branch->name}}" readonly="readonly">
                @endif
              </div>
          </div><br>
          <div class="row">
              <?php
              $trim_photo = trim($notice_boards->image, '[ ] ');
              $photo = explode(',', $trim_photo);

              // dd($photo);
              ?>
              <!-- <div class="row"> -->

                  @if ($notice_boards->image == '[]')
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

              <!-- </div> -->
          </div>
          <br><br>
        </form>
    </div>
@stop 
@section('css')

@stop



@section('js')

@stop