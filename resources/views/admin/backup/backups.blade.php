@extends('adminlte::page')

@section('title', 'Backup Manager')

@section('content_header')
<script src=" {{ asset('toasterjquery.js') }}" ></script>
<link rel="stylesheet" type="text/css" href="{{asset('toasterbootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('toastermin.css')}}">
<script type="text/javascript" src="{{asset('toastermin.js')}}"></script>
     <h3>Backup Lists</h3>

@stop
@section('content')
<div class="row">
  <div class="col-md-11">
            
        </div>
             <div class="col-xs-1 clearfix">
                <a id="create-new-backup-button" href="{{ url('backup/create') }}" class="btn btn-primary pull-right"
                   style="margin-bottom:2em;"><i
                        class="fa fa-plus"></i> Create New!!
                </a>
            </div>  
</div>

        

<div class="page_body">

       
       
       <div class="row">
        
            <br>
            <div class="table-responsive" style="font-size:15px">
                @if (count($backups))

                    <table class="table table-bordered styled-table">
                        <thead>
                        <tr>
                            <th>File</th>
                            <th>Size</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($backups as $backup)
                            <tr>
                                <td>{{ $backup['file_name'] }}</td>
                                <td>{{ $backup['file_size'] }}</td>
                                <td>
                                    {{ date('d-m-Y H:m:i',$backup['last_modified']) }}
                                </td>
                                <td class="text-right">
                                    <!-- <a class="btn btn-xs btn-default"
                                       href="{{ url('backup/download/'.$backup['file_name']) }}"><i
                                            class="fa fa-cloud-download"></i> Download</a>
                                    <a class="btn btn-xs btn-danger" data-button-type="delete"
                                       href="{{ url('backup/delete/'.$backup['file_name']) }}"><i class="fa fa-trash-o"></i>
                                        Delete</a> -->
                                <form action="{{ url('backup/delete/'.$backup['file_name']) }}" method="post"
                                    onsubmit="return confirm('Do you want to delete?');">
                                   @csrf
                                   @method('DELETE')

                                    <a class="btn btn-xs btn-default"
                                       href="{{ url('backup/download/'.$backup['file_name']) }}"><i
                                            class="fa fa-cloud-download"></i> Download</a>

                                    <button class="btn btn-sm btn-danger btn-sm" type="submit" value="Delete">
                                        <i class="fa fa-fw fa-trash" title="Delete"></i>
                                    </button>
                                </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="well">
                        <h4>There are no backups</h4>
                    </div>
                @endif
            </div>
        </div>

</div>
@stop



@section('css')
 
@stop



@section('js')
<script> 
    @if(Session::has('success'))
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.success("{{ session('success') }}");
        @endif
        @if(Session::has('error'))
          toastr.options =
          {
            "closeButton" : true,
            "progressBar" : true
          }
                toastr.error("{{ session('error') }}");
          @endif
    $("document").ready(function(){
    setTimeout(function(){
        $("div.alert").remove();
    }, 3000 ); // 3 secs

});
</script>

@stop

