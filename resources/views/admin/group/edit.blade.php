@extends('adminlte::page')

@section('title', 'Group Edit')

@section('content_header')

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<style type="text/css">
    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 35px;
        user-select: none;
        -webkit-user-select: none; 
    }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 30px;
        position: absolute;
        top: 2px;
        right: 0px;
        left: 365px;
        width: 100px; 
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: black;
    }
</style>
@stop
@section('content')
 <div class="container" >
        <form action="{{route('groups.update',$groups[0]->department_id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

   {{--  <div class="row">       
        <label class="col-md-2 unicode">Branch Name</label>
        <div class="col-md-4 {{ $errors->first('name', 'has-error') }}">
            
            <select class="form-control" name="branch_id" id="branch_id" style="font-size: 13px">
                <option value="">Select Branch</option>
                @foreach ($branches as $branch )
                  <option  value="{{$branch->id}}" @if($branch->id=== $groups[0]->branch_id) selected='selected' @endif>{{$branch->name}}</option>
                @endforeach
            </select>  
         
        </div>    
    </div>
    <br> --}}

    <div class="row">  
        <label class="col-md-2 unicode">Department</label>
        <div class="col-md-4 {{ $errors->first('name', 'has-error') }}">
            
            <select class="form-control" name="dep_id" id="dep_id" style="font-size: 13px">
                <option value="">Select Department</option>
                @foreach ($departments as $department )
                  <option  value="{{$department->id}}" @if($department->id=== $groups[0]->department_id) selected='selected' @endif>{{$department->name}}</option>
                @endforeach
            </select> 
         
        </div>    
    </div>
    <br>

    <div class="row">
        <div class="col-md-6">
             <div class="row">
               
                <label class="col-md-4 unicode">Group</label>
                <div class="col-md-8 {{ $errors->first('group', 'has-error') }}">
                    
                    <select class="form-control" name="group_a" style="font-size: 13px">
                        <option  value="A">A</option> 
                    </select>  
                 
                </div>    
            </div>
            <br>
            
            <div class="row">
                <label class="col-md-4 unicode">Employee Name</label>
                <div class="col-md-8 {{ $errors->first('name', 'has-error') }}">
                    <select multiple class="livesearch form-control" name="a_emp_id[]">
                        @foreach($groups as $skey=>$group)
                            @if($group->group == 'A')                                   
                                <option value="{{$group->emp_id }}"}} selected>
                                  {{ $group->employees[0]->name }}
                                </option>
                            @endif
                        @endforeach  
                    </select>
                </div>    
            </div>
        
        </div>
         <div class="col-md-6">
            <div class="row">
                <div class="col-md-8 {{ $errors->first('group', 'has-error') }}">
                    <select class="form-control" name="group_b" style="font-size: 13px">
                        <option  value="B">B</option>  
                    </select>  
                 
                </div>    
            </div>
            <br>
             <div class="row">
                <div class="col-md-8 {{ $errors->first('name', 'has-error') }}">
                    <select multiple class="livesearch form-control" name="b_emp_id[]">
                         @foreach($groups as $skey=>$group)
                            @if($group->group == 'B')                                   
                                <option value="{{$group->emp_id }}"}} selected>
                                {{ $group->employees[0]->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>    
            </div>
        
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-5">
            <a class="btn btn-primary unicode" href="{{route('groups.index')}}"> Back</a>
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
@stop

@section('js')
<script type="text/javascript" src="{{ asset('select2/js/select2.min.js') }}"></script>
<script src="{{ asset('jquery-ui.js') }}"></script>
<script type="text/javascript">
    $(function() {

        var branch_id = $("#branch_id").val();
        var dep_id = $("#dep_id").val();
        $("#branch_id").change(function(){
            branch_id = $(this).val();
        });

        $("#dep_id").change(function(){
            dep_id = $(this).val();
            getEmployee(branch_id,dep_id)
        });


        getEmployee(branch_id,dep_id);
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