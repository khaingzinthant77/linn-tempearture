@extends('adminlte::page')

@section('title', 'KPI Dashboard')

@section('content_header')

<?php
  $year = isset($_GET['year'])?$_GET['year']:date('Y'); 
  $month = isset($_GET['month'])?$_GET['month']:date('F'); 
?>    
<div class="row">
    <div class="col-md-4">
        <form action="{{route('kpi-dashboard')}}" method="get" accept-charset="utf-8" class="form-horizontal">
            <div class="row">
              <div class="col-md-3">
                 <label for="">Month</label>
                 <input type="text" name="month" id="month"class="form-control unicode" placeholder="June" value="{{ old('month',$month) }}" style="font-size: 13px">
              </div>  
              <div class="col-md-3">
                  <label for="">Year</label>
                  <input type="text" name="year" id="year"class="form-control unicode" placeholder="2021" value="{{ old('year',$year) }}" style="font-size: 13px">
              </div>
            </div>
        </form>
    </div>
    <div class="col-md-4 text-center">
         <h5 style="color: blue;" class="unicode">KPI Dashboard</h5>
    </div>
    <div class="col-md-4 text-right">
        <h6 style="color: blue;" class="unicode"> <i class="fa fa-clock"></i> {{ date('d-m-Y')}} </h6>
    </div>
   
</div>
  
@stop

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-12" align="center">
          <div id="depkpichart" style="height: 300px;"></div>
        </div>
       
    </div>
    <br>
    <hr>
    <div class="row justify-content-center">
       <div class="col-md-6"  align="center">
             <div id="bchart" style="height: 300px;"></div>
        </div>
        <div class="col-md-6" align="center">
            <p><i class="fas fa-trophy "></i>  {{ date('F') }} 's Best Employee </p>
              <div class="table-responsive" style="font-size:14px">

                <table class="table table-bordered styled-table">
                     <thead>
                         <th>Photo</th>
                         <th>Name</th>
                         <th>Point</th>
                     </thead>
                     <tbody>
                        @foreach($bestEmployees as $bemp)
                         <tr class="table-tr" data-url="{{route('kpi.show',$bemp->kpiid)}}">
                            <td align="center">
                             @if($bemp->photo == '')
                             <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="40px" height="40px">
                             @else
                             <img src="{{ asset('uploads/employeePhoto/'.$bemp->photo)}}" alt="photo" width="40px" height="40px">
                             @endif
                            </td>
                             <td>
                                {{ $bemp->empID }} <br>
                                {{ $bemp->empname }} ({{ $bemp->department }})<br>
                                {{ $bemp->branch }}
                              </td>
                             <td>{{ $bemp->total }}</td>
                         </tr>
                        @endforeach
                     </tbody>
                 </table>
                  Total: {{ $bestEmployees->count()}} 
             </div>
        </div>
       
    </div>
    <br>


  <br><br>
    
@stop


@section('css')
 <link id="bsdp-css" href="{{ asset('/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet">
@stop

@section('js')
  <script src="{{ asset('/js/bootstrap-datepicker.min.js')}}"></script>
    <!-- Charting library -->
    <script src="{{ asset('js/chart.min.js') }}"></script>
    <!-- Chartisan -->
    <script src="{{ asset('js/chartisan_chartjs.umd.js') }}"></script>

    <!-- Your application script -->
     <script>

      $(function() {
    
        $("#year").datepicker({  format: "yyyy",
          viewMode: "years", 
          minViewMode: "years" 
        });

          $("#month").datepicker({  format: "MM",
              viewMode: "months", 
              minViewMode: "months" 
          });

          $('#year').on('change',function(e) {
            this.form.submit();
          });

          $('#month').on('change',function(e) {
            this.form.submit();
          });

      });

    
      

      var branchArr = <?php echo '["' . implode('", "', $branchArr) . '"]' ?>;
      var bkpiArr = <?php echo '["' . implode('", "', $bkpiArr) . '"]' ?>;

        const bchart = new Chartisan({
              el: '#bchart',
              // url: 'https://chartisan.dev/chart/example.json',
              data: {
                  "chart": { "labels": branchArr },
                  "datasets": [
                    { "name": "", "values": bkpiArr },
                    { "name": "", "values": bkpiArr }
                  ]
                },
              hooks: new ChartisanHooks()
                 .colors(['#FBA900'])
                .responsive()
                .beginAtZero()
                .legend({ position: 'bottom' })
                .borderColors()
                .title('KPI by Branch')
                .datasets([{ type: 'line', fill: false }, 'bar'])
        });


        var deptArr = <?php echo '["' . implode('", "', $deptArr) . '"]' ?>;
        var kpiArr = <?php echo '["' . implode('", "', $kpiArr) . '"]' ?>;


        const depkpichart = new Chartisan({
              el: '#depkpichart',
              // url: 'https://chartisan.dev/chart/example.json',
              data: {
                  "chart": { "labels": deptArr },
                  "datasets": [
                    { "name": "", "values": kpiArr },
                    { "name": "", "values": kpiArr }
                  ]
                },
              hooks: new ChartisanHooks()
                .colors(['#00CAA9'])
                .responsive()
                .beginAtZero()
                .legend({ position: 'bottom' })
                .borderColors()
                .title('KPI by Department')
                .datasets([{ type: 'line', fill: false }, 'bar'])
        });

        $(function() {
          $('table').on("click", "tr.table-tr", function() {
            window.location = $(this).data("url");
          });
        });


    </script>
@stop