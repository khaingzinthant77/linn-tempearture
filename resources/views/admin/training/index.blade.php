@extends('adminlte::page')

@section('title', 'Training')

@section('content_header')

    <h5 style="color: blue;">Training Management</h5>
@stop
@section('content')
 <?php
  $name = isset($_GET['name'])?$_GET['name']:''; 
  $from_date = isset($_GET['from_date'])?$_GET['from_date']:'';
  $to_date = isset($_GET['to_date'])?$_GET['to_date']:'';
  ?>
<br>

<form action="{{route('training.index')}}" method="get" accept-charset="utf-8" class="form-horizontal unicode" >
            <div class="row form-group" id="adv_filter">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="" class="unicode">Search by Keyword</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Search..." value="{{ old('name',$name) }}" style="font-size: 13px">
                        </div> 

                         <div class="col-md-2">
                            <label for="" class="unicode">From Date</label>
                             <input type="text" name="from_date" id="from_date"class="form-control unicode" placeholder="01-08-2020" value="{{ old('from_date',$from_date) }}" style="font-size: 13px">
                        </div> 

                         <div class="col-md-2">
                            <label for="" class="unicode">To Date</label>
                             <input type="text" name="to_date" id="to_date"class="form-control unicode" placeholder="01-08-2020" value="{{ old('to_date',$to_date) }}" style="font-size: 13px">
                        </div> 

                         <div class="col-md-6">
                          @can('training-create')
                           <a class="btn btn-success unicode" href="{{route('training.create')}}" style="float: right;font-size: 13px"><i class="fas fa-plus"></i> Training</a>
                           @endcan
                         </div>
                    </div>
                </div>
               
            </div>
</form>


 <p style="padding-top: 20px">Total record: {{$count}}</p>
  <div class="table-responsive" style="font-size:13px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Period</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Trainer Name</th>
                        <th>Trainer Info</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                    <tbody>
                    @if($trainings->count()>0)
                     @foreach($trainings as $training)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$training->name}}</td>
                            <td>{{$training->description}}</td>
                            <td>{{$training->peroid}}</td>
                            <td>{{date('d-m-Y',strtotime($training->start_date))}}</td>
                             <td>{{date('d-m-Y',strtotime($training->end_date))}}</td>
                             <td>{{$training->trainer_name}}</td>
                             <td>{{$training->trainer_info}}</td>
                            <td>
                                <form action="{{route('training.destroy',$training->id)}}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')
                                  
                                    <a class="btn btn-sm btn-info" href="{{route('training.show',$training->id)}}"><i class="fa fa-fw fa-eye" /></i></a> 
                                   
                                    @can('training-edit')
                                    <a class="btn btn-sm btn-primary" href="{{route('training.edit',$training->id)}}"><i class="fa fa-fw fa-edit"></i></a>
                                    @endcan
                                    @can('training-delete')
                                    <button class="btn btn-sm btn-danger btn-sm" type="submit">
                                        <i class="fa fa-fw fa-trash" title="Delete"></i>
                                    </button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                         @endforeach
                          @else
                          <tr align="center">
                            <td colspan="10">No Data!</td>
                          </tr>
                  @endif
                        
                    </tbody>
           </table> 
           {!! $trainings->appends(request()->input())->links() !!}
       </div>   
@stop 
@section('css')
<link id="bsdp-css" href="{{ asset('/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
@stop

@section('js')
 <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
<script> 
  @if(Session::has('success'))
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.success("{{ session('success') }}");
  @endif

  $(function(){

     $('#name').on('change',function(e) {
                this.form.submit();
     }); 

     
  });

   $(document).ready(function(){

    $("#from_date").datepicker({ format: 'dd-mm-yyyy' });
    $("#to_date").datepicker({ format: 'dd-mm-yyyy' });

      $('#from_date').on('change',function(e) {
                  this.form.submit();
      });

      $('#to_date').on('change',function(e) {
                  this.form.submit();
      });

         
    });
       
</script>
@stop