@extends('adminlte::page')

@section('title', 'Employee')

@section('content_header')
<script src="{{ asset('js/jquery-3.4.1.slim.min.js')}}"></script>
@stop

@section('content')
 
    <!-- <div class="row">
        <div class="col-lg-11">
            <a class="btn btn-success unicode" href="{{route('employee.index')}}"> Back</a>
        </div>
    </div><br> -->
  <form action="{{route('jobopening.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div class="row form-group">
        	<div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Department</label>
                                </div>

                                <div class="col-md-8 {{ $errors->first('dep_id', 'has-error') }}">

                                      <select class="form-control ctr_item_option" name="dep_id" id="select_1" >
			                             <option value="">Department</option>
                                        @foreach ($departments as $department )
                                          <option  value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
			                       
			                        </select> 
                                      @if($errors->first('dep_id'))
                                        <span class="help-block">
                                            <small>{{ $errors->first('dep_id') }}</small>
                                        </span>
                                     @endif


                                </div>
                            </div>
              </div>
        </div>


          <div class="row form-group">
          <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Position</label>
                                </div>

                                <div class="col-md-8 {{ $errors->first('position_id', 'has-error') }}">

                                      <select class="form-control ctr_item_option" name="position_id" id="select_1" >
                                   <option value="">Position</option>
                                        @foreach ($positions as $position )
                                          <option  value="{{$position->id}}">{{$position->name}}</option>
                                        @endforeach
                             
                              </select> 
                                      @if($errors->first('position_id'))
                                        <span class="help-block">
                                            <small>{{ $errors->first('position_id') }}</small>
                                        </span>
                                     @endif


                                </div>
                            </div>
              </div>
        </div>

         <div class="row form-group">
            <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Title</label>
                                </div>

                                <div class="col-md-8 $errors->first('title', 'has-error')">

                                       <input type="text" name="title" class="form-control unicode" id="title" > 
                                         @if($errors->first('title'))
                                            <span class="help-block">
                                                <small>{{ $errors->first('title') }}</small>
                                            </span>
                                         @endif

                                </div>
                            </div>
              </div>
        </div>


        <div class="row form-group">
            <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Description</label>
                                </div>

                                <div class="col-md-8 $errors->first('description', 'has-error')">
                                        <textarea name="description" rows="4" class="form-control unicode" id="description"></textarea>

                                         @if($errors->first('description'))
                                            <span class="help-block">
                                                <small>{{ $errors->first('description') }}</small>
                                            </span>
                                         @endif

                                </div>
                            </div>
              </div>
        </div>

         <div class="row form-group">
            <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Photo</label>
                                </div>

                                <div class="col-md-8">
                                <input type="file" name="photo" class="form-control unicode">

                                </div>
                            </div>
              </div>
        </div>

        <div class="row form-group">
            <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Posted Date</label>
                                </div>

                                <div class="col-md-8 $errors->first('posted_date', 'has-error')">

                                       <input type="text" name="posted_date" class="form-control unicode" id="posted_date" placeholder="01-10-2021"> 
                                        @if($errors->first('posted_date'))
                                            <span class="help-block">
                                                <small>{{ $errors->first('posted_date') }}</small>
                                            </span>
                                         @endif

                                </div>
                            </div>
              </div>
        </div>

         <div class="row form-group">
        	<div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Last Date</label>
                                </div>

                                <div class="col-md-8 $errors->first('last_date', 'has-error')">

                                    <input type="text" name="last_date" class="form-control unicode" placeholder="01-10-2021" id="last_date"> 
                                     @if($errors->first('last_date'))
                                            <span class="help-block">
                                                <small>{{ $errors->first('last_date') }}</small>
                                            </span>
                                    @endif

                                </div>
                            </div>
              </div>
        </div>

         <div class="row form-group">
        	<div class="col-md-6">
                            <div class="row salary">
                                <div class="col-md-3">
                                    <label>Close Date</label>
                                </div>

                                <div class="col-md-8 $errors->first('close_date', 'has-error')">

                                    <input type="text" name="close_date" class="form-control unicode" placeholder="01-01-2021" id="close_date">
                                     @if($errors->first('close_date'))
                                            <span class="help-block">
                                                <small>{{ $errors->first('close_date') }}</small>
                                            </span>
                                    @endif 

                                </div>
                            </div>
              </div>
        </div>

        <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-5">
                        <a class="btn btn-primary unicode" href="{{route('jobopening.index')}}"> Back</a>
                        <button type="submit" class="btn btn-success unicode" onClick="javascript:p=true;" style="height: 34px;font-size: 13px">Save</button>
                    </div>
            </div><br>
        	 
                        
        </div>
  </form>
@stop 



@section('css')
<link id="bsdp-css" href="{{ asset('/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
    <style type="text/css" media="screen">
      .error_msg{
        color: #DD4B39;
      }
      .has-error input{
        border-color: #DD4B39;
      }
      .help-block{
        color: #DD4B39;
      }

  </style>
@stop



@section('js')
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		 $("#posted_date").datepicker({ dateFormat: 'dd-mm-yy' });
         $("#last_date").datepicker({ dateFormat: 'dd-mm-yy' });
         $("#close_date").datepicker({ dateFormat: 'dd-mm-yy' });

	});
</script>
@stop