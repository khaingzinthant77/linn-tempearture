@extends('adminlte::page')

@section('title', 'Leave Application')

@section('content_header')

@stop
@section('content')
<div class="row">
    <div class="col-lg-10">
         <a class="btn btn-success unicode" href="{{route('leave_application.index')}}"> Back</a>
    </div>
    <div class="col-lg-2">
        <div class="pull-right">
          <form action="{{route('leave_application.destroy',$leave_application->id)}}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                            @csrf
                            @method('DELETE')
                            @can('leave-edit')
                            <a class="btn btn-sm btn-primary" href="{{route('leave_application.edit',$leave_application->id)}}"><i class="fa fa-fw fa-edit" /></i></a>
                            @endcan

                            @can('leave-delete')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash" /></i></button> 
                            @endcan
          </form>
        </div>
    </div>
</div><br>
 <div class="container" >
        <form action="{{route('leave_application.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('post')
        <div class="row">
            <div class="col-md-6">
                <div class="row">
               
                <label class="col-md-3 unicode">Employee Name</label>
                <div class="col-md-7 {{ $errors->first('name', 'has-error') }}">
                    <input type="text" name="emp_id" value="{{$leave_application->employee->name}}" class="form-control" readonly="readonly">
                </div>    
            </div><br>
              <div class="row">
                       
                <label class="col-md-3 unicode">Leave Type</label>
                <div class="col-md-7 {{ $errors->first('leave_type', 'has-error') }}">
                 <input type="text" name="leave_type" value="{{$leave_application->leave_type->leave_type}}" class="form-control" readonly="readonly">
                </div>    
            </div><br>
            <div class="row">
                       
                <label class="col-md-3 unicode">Full Day/Half Day</label>
                <div class="col-md-7 {{ $errors->first('halforfull', 'has-error') }}">
                    
                    <input type="text" name="halforfull" id="halforfull" class="form-control" @if($leave_application->halforfull == 1) value="Half Day" @else value = "Full Day" @endif readonly="readonly">
                 
                </div>    
            </div><br>
            @if($leave_application->halforfull == 1)
            <div class="row">
                       
                <label class="col-md-3 unicode">Half Day</label>
                <div class="col-md-7 {{ $errors->first('halfDayType', 'has-error') }}">
                    
                    <input type="text" name="halfDayType" id="halfDayType" class="form-control" @if($leave_application->halfDayType == 0) value="Morning" @else value = "Evening" @endif readonly="readonly">
                 
                </div>    
            </div><br>
            @endif

            <div class="row">
                       
                <label class="col-md-3 unicode">Start Date</label>
                <div class="col-md-7 {{ $errors->first('start_date', 'has-error') }}">
                    
                    <input type="text" name="start_date" id="start_date" class="form-control" placeholder="12/02/2021" value="{{$leave_application->start_date}}" readonly="readonly">
                 
                </div>    
            </div><br>

            <div class="row">
                       
                <label class="col-md-3 unicode">End Date</label>
                <div class="col-md-7 {{ $errors->first('end_date', 'has-error') }}">
                    
                    <input type="text" name="end_date" id="end_date" class="form-control" placeholder="12/03/2021" value="{{$leave_application->end_date}}" readonly="readonly">
                 
                </div>    
            </div><br>
            <div class="row">
                       
                <label class="col-md-3 unicode">Days</label>
                <div class="col-md-7 {{ $errors->first('day', 'has-error') }}">
                    
                    <input type="text" name="day" id="day" class="form-control" placeholder="1" value="{{$leave_application->days}}" readonly="readonly">
                 
                </div>    
            </div><br>
             <div class="row">
                       
                <label class="col-md-3 unicode">Apply Date</label>
                <div class="col-md-7 {{ $errors->first('apply_date', 'has-error') }}">
                    
                    <input type="text" name="apply_date" id="apply_date" class="form-control" placeholder="12/01/2021" value="{{$leave_application->apply_date}}" readonly="readonly">
                 
                </div>    
            </div><br>
            <div class="row">
                       
                <label class="col-md-3 unicode">Reason</label>
                <div class="col-md-7 {{ $errors->first('reason', 'has-error') }}">
                    
                    <!-- <input type="text" name="reason" id="reason" class="form-control" placeholder="--"> -->
                    <textarea class="form-control" readonly="readonly">{{$leave_application->reason}}</textarea>
                 
                </div>    
            </div><br>
            
            </div>
            <div class="col-md-6">
                <div class="row">
                       
                <label class="col-md-3 unicode">Application Status</label>
                <div class="col-md-7 {{ $errors->first('apply_status', 'has-error') }}">
                    @if($leave_application->application_status == 0)
                   <input type="text" name="application_status" class="form-control" value="Pending" readonly="readonly">
                   @elseif($leave_application->application_status == 1)
                   <input type="text" name="application_status" class="form-control" value="Approved" readonly="readonly">
                   @else
                    <input type="text" name="application_status" class="form-control" value="Rejected" readonly="readonly">
                   @endif
                </div>    
            </div><br>
            <div class="row">
                <label class="col-md-3 unicode">Approved Reason</label>
                <div class="col-md-7">
                    <input type="text" name="approve_reason" id="approve_reason" class="form-control" value="{{$leave_application->approve_reason}}" readonly="readonly">
                </div>
            </div>
            </div>
        </div>
       
        </form>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop