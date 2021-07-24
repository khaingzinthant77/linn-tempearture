@extends('adminlte::page')

@section('title', 'HR Dashboard')

@section('content_header')
<div class="row">
    <div class="col-md-6">
         <h5 style="color: blue;" class="unicode">HR Dashboard</h5>
    </div>
    <div class="col-md-6 text-right">
        <h6 style="color: blue;" class="unicode"> <i class="fa fa-clock"></i> {{ date('d-m-Y')}} </h6>
    </div>
</div>
  
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>{{ $emp_count}}</h3>

              <p>ဝန်ထမ်းစုစုပေါင်း</p>
            </div>
            <div class="icon">
             <i class="fa fa-users "></i>
            </div>
            <a href="{{ url("/employee") }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$total_departments}}</h3>

              <p>ဌာန</p>
            </div>
            <div class="icon">
               <i class="fa fa-building"></i>
            </div>
            <a href="{{ url('department') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow" style="color: white !important">
            <div class="inner">
              <h3>{{$total_branches}}</h3>

              <p>ဆိုင်ခွဲ</p>
            </div>
            <div class="icon">
               <i class="fa fa-university "></i>
            </div>
            <a href="{{ url('branch') }}" class="small-box-footer"  style="color: white !important">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$new_empoyee}}</h3>

              <p>ဝန်ထမ်းအသစ်</p>
            </div>
            <div class="icon">
               <i class="fa fa-users "></i>
            </div>
            <a href="{{ url("/employee?new_emp=1") }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
    </div>
    <hr>

    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-cyan">
            <div class="inner">
              <h3>{{ $attendance_count}}</h3>

              <p>ရုံးတက်သူများ</p>
            </div>
            <div class="icon">
             <i class="fa fa-users "></i>
            </div>
            <a href="{{ url("/attendance?attendance_date=".date('d-m-Y')) }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3 style="color: white">{{$leave_count}}</h3>

              <p style="color: white">ခွင့်ယူထားသူများ</p>
            </div>
            <div class="icon">
               <i class="fa fa-users"></i>
            </div>
            <a style="color: white !important;" href="{{ url('leave_application?date='.date('d-m-Y')) }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple" style="color: white !important">
            <div class="inner">
              <h3>{{$offday_count}}</h3>

              <p>နားသူများ</p>
            </div>
            <div class="icon">
               <i class="fa fa-users "></i>
            </div>
            <a href="{{ url('offday?name=&date='.date('d-m-Y')) }}" class="small-box-footer"  style="color: white !important">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-secondary">
            <div class="inner">
              <h3>{{$overtime_count}}</h3>

              <p>အချိန်ပိုဆင်းသူများ</p>
            </div>
            <div class="icon">
               <i class="fa fa-clock "></i>
            </div>
            <a href="{{ url("/overtime?date=".date('d-m-Y')) }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

    <div class="row justify-content-center">
        <div class="col-md-6" align="center">
          <div id="pconchart" style="height: 300px;"></div>
        </div>
        <div class="col-md-6"  align="center">
             <div id="chart1" style="height: 300px;"></div>
        </div>
    </div>
    <br>
    <hr>
      <div class="row justify-content-center">
        <div class="col-md-6" align="center">
          <div id="leavechart" style="height: 300px;"></div>
        </div>
        <div class="col-md-6"  align="center">
             <div id="otchart" style="height: 300px;"></div>
        </div>
    </div>
    <br>
    <hr>
  <div class="row">
        <div class="col-md-6">
            <p><i class="fa fa-home"></i>  {{ date('d-M-Y') }} နားသူများ - {{ $offday_employess->count() }}</p>
              <div class="table-responsive" style="font-size:14px">
                <table class="table table-bordered styled-table">
                     <thead>
                         <th>Photo</th>
                         <th>Name</th>
                         <th>Branch</th>
                         <th>Department</th>
                     </thead>
                     <tbody>
                        @foreach($offday_employess as $offemp)
                         <tr>
                            <td align="center">
                             @if($offemp->photo == '')
                             <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="40px" height="40px">
                             @else
                             <img src="{{ asset('uploads/employeePhoto/'.$offemp->photo)}}" alt="photo" width="40px" height="40px">
                             @endif
                            </td>
                             <td>{{ $offemp->empname }}</td>
                             <td>{{ $offemp->branch_name }}</td>
                             <td>{{ $offemp->dep_name }}</td>

                         </tr>
                        @endforeach
                     </tbody>
                 </table>
             </div>
              {!! $offday_employess->appends(request()->input())->links() !!}
        </div>
          
    <div class="col-md-6"  align="center">
        <p><i class="fa fa-birthday-cake"></i>  {{ date('M') }} Birthdays</p>
        <div id='calendar'></div>
    </div>

  </div>

  <br><br>
    
@stop

<?php
$arr1 = []; 
$arr0 = [];
foreach($bd_employess as $bdemp){
    $darr = explode("-", $bdemp['date_of_birth']);
    if(sizeof($darr)==3){
        if(checkdate($darr[1],$darr[2],$darr[0])){

            $a = ['title'=>$bdemp['name'], 'start'=> date('Y-').date('m-d',strtotime($bdemp['date_of_birth'])) ];
            array_push($arr1, $a);
            array_push($arr0,date('Y-').date('m-d',strtotime($bdemp['date_of_birth'])));
        }
    }
}
$date = date('Ymd')."";


?>

@section('css')
  <link href='{{ asset("calender/fullcalendar.min.css") }}' rel='stylesheet' />
  <link href='{{ asset("calender/fullcalendar.print.min.css") }}' rel='stylesheet' media='print' />
  <style>
     #calendar {
        max-width: 95%;
        margin: 0 auto;
        font-family:Pyidaungsu,Yunghkio,'Masterpiece Uni Sans' !important;
        font-size: 13px;
    }
    .fc-content{
      color: white;
    }
  </style>
@stop

@section('js')
    <!-- Charting library -->
    <script src="{{ asset('js/chart.min.js') }}"></script>
    <!-- Chartisan -->
    <script src="{{ asset('js/chartisan_chartjs.umd.js') }}"></script>

    <script src="{{ asset('js/jquery.min.js') }}"></script> 
    <script src='{{ asset("calender/moment.min.js") }}'></script>
    <script src='{{ asset("calender/fullcalendar.min.js") }}'></script>
    <!-- Your application script -->
     <script>

        var deptArr = <?php echo '["' . implode('", "', $deptArr) . '"]' ?>;
        var deptAttCountArr = <?php echo '["' . implode('", "', $deptAttCountArr) . '"]' ?>;

        const chart = new Chartisan({
          el: '#chart1',
          // url: 'https://chartisan.dev/chart/example.json',
          data: {
              "chart": { "labels": deptArr },
              "datasets": [
                 { "name": "စုစုပေါင်း ", "values":deptAttCountArr }
               
              ]
            },
          hooks: new ChartisanHooks()
            .beginAtZero()
            .colors(['#C55539'])
            .legend({ position: 'bottom' })
            .title('ဌာနအလိုက်အလုပ်ဆင်းသူများ')
        });


        var leavDeptArr = <?php echo '["' . implode('", "', $leavDeptArr) . '"]' ?>;
        var leavDeptCountArr = <?php echo '["' . implode('", "', $leavDeptCountArr) . '"]' ?>;

        const leavechart = new Chartisan({
          el: '#leavechart',
          // url: 'https://chartisan.dev/chart/example.json',
          data: {
              "chart": { "labels": leavDeptArr },
              "datasets": [
                 { "name": "စုစုပေါင်း ", "values":leavDeptCountArr }
               
              ]
            },
          hooks: new ChartisanHooks()
            .beginAtZero()
            .colors(['#4172bd'])
            .legend({ position: 'bottom' })
            .title('ခွင့်ယူထားသူများ')
        });


        var branchArr = <?php echo '["' . implode('", "', $branchArr) . '"]' ?>;
        var branchAttCountArr = <?php echo '["' . implode('", "', $branchAttCountArr) . '"]' ?>;

        const pconchart = new Chartisan({
              el: '#pconchart',
              // url: 'https://chartisan.dev/chart/example.json',
              data: {
                  "chart": { "labels": branchArr },
                  "datasets": [
                    { "name": "စုစုပေါင်း", "values": branchAttCountArr }
                  ]
                },
              hooks: new ChartisanHooks()
                .colors(['#5E18EB'])
                .responsive()
                .beginAtZero()
                .legend({ position: 'bottom' })
                .title('ဆိုင်ခွဲအလိုက် အလုပ်ဆင်းသူများ')
        });


        var offDeptArr = <?php echo '["' . implode('", "', $offDeptArr) . '"]' ?>;
        var offDeptCountArr = <?php echo '["' . implode('", "', $offDeptCountArr) . '"]' ?>;

        const otchart = new Chartisan({
              el: '#otchart',
              // url: 'https://chartisan.dev/chart/example.json',
              data: {
                  "chart": { "labels": offDeptArr },
                  "datasets": [
                    { "name": "စုစုပေါင်း", "values": offDeptCountArr }
                  ]
                },
              hooks: new ChartisanHooks()
                .colors(['#62C500'])
                .responsive()
                .beginAtZero()
                .legend({ position: 'bottom' })
                .title('နားသူများ')
        });

   

    var bdEmployees = <?php echo json_encode($arr0); ?>;
    $(document).ready(function() {
        console.log(<?php echo json_encode($arr1); ?>);
        $('#calendar').fullCalendar({
            defaultDate: new Date(),
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: <?php echo json_encode($arr1); ?>
        });
        
        $('#calendar').delegate('.fc-day', 'mouseover', function(){
            if(bdEmployees.indexOf($(this).attr('data-date'))=="-1"){
                pointerdate = $(this).attr('data-date');
                curdate = <?php echo $date; ?>;
                // console.log(curdate);
                arr=pointerdate.split('-');
                pointerdate = arr[0]+arr[1]+arr[2];
                // console.log(" > "+pointerdate);
                if(pointerdate<=curdate){
                    return false;
                }
            }
        });

        $('#calendar').delegate('.fc-day a', 'mouseover', function(){
         // alert("a mouseover");
        });

        $('#calendar').delegate('.fc-day', 'mouseout', function(){
            $(this).html('');
            $(this).css('background', '#ffffff');
        });

    });

    </script>
@stop