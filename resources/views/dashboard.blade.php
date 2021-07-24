@extends('adminlte::page')

@section('title', 'Main Dashboard')

@section('content_header')
    <h5 style="color: blue;" class="unicode">Main Dashboard</h5>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>{{ $total_employees}}</h3>

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

 	<div class="row justify-content-center">
 		<div class="col-md-6" align="center">
 			
      <div id="pconchart" style="height: 300px;"></div>
 		</div>
 		<div class="col-md-6"  align="center">
 			<div id="fmpie" style="height: 300px;"></div>
 		</div>
 	</div>
 	<br>
 	<hr>
  <div class="row">
    <div class="col-md-6">
      <div id="chart1" style="height: 300px;"></div>
    </div>
    <div class="col-md-6">
            {{-- <div id="piechart" style="height: 300px;"></div> --}}
            <div id="pconpie" style="height: 300px;"></div>
    </div>
  </div>
  <br>
  <hr>
 	<div class="row">
        <div class="col-md-6"  align="center">
          <div id="bhchart" style="height: 300px;"></div>
        </div>
        	
 		<div class="col-md-6"  align="center">
	 		   <div id="bhPie" style="height: 300px;"></div>
 		</div>

 	</div>

 	<br><hr>

  <div class="row">
        <div class="col-md-6">
          <p><i class="fas fa-envelope"></i>Notice Board</p>
          @foreach($notice_boards as $notice_board)
          <div class="row div-click" data-url="{{route('notice_board_show',$notice_board->id)}}" style="cursor: pointer"> 
            <img src="{{ asset('announed.png') }}" alt="photo" width="80px" height="80px">
            <div style="width: 500px;">
              <p style="margin-left: 10px;">{{date('d-m-Y',strtotime($notice_board->publish_date))}}</p>
              <h6 style="margin-left: 10px;">{{$notice_board->title}}</h6>
              <p style="margin-left: 10px;">{{$notice_board->description}}</p>
            </div>
            <!-- <a href="" class="btn btn-success readmore" style="height: 30px;margin-left: 20px;"><i class="fas fa-calendar-week"></i>{{date('d-m-Y',strtotime($notice_board->publish_date))}}</a> -->
          </div>
          <hr>
          @endforeach
        </div>
          
    <div class="col-md-6"  align="center">
        <h6>Upcoming Employee's Birthday</h6>
        <div id='calendar'></div>
    </div>

  </div>

  <br><hr>

  <div class="row">
    <div class="col-md-6" align="center">
      
    </div>
    <div class="col-md-6"></div>
  </div>
  <br>
  <br>
 	
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


$hostel = [];
$fmcount = [];
$mcount = [];

foreach ($hostelArr as $key => $hstarr) {
  array_push($hostel, $hstarr->name);
  array_push($fmcount, $hstarr->fmcont);
  array_push($mcount, $hstarr->mcont);
}


$branchArr = [];
$bhMale = [];
$bhFemale = [];

$brhTotalArr = [];
$tcount = 0;

foreach ($branchHostelArr as $key => $brh) {
  array_push($branchArr, $brh->name);
  array_push($bhMale, $brh->hmcont);
  array_push($bhFemale, $brh->hfmcont);

  $tcount =  $brh->hmcont +  $brh->hfmcont; 

  array_push($brhTotalArr, $tcount);

}


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

     	var deptsArr = <?php echo '["' . implode('", "', $deptArr) . '"]' ?>;
     	var deptEmpArr = <?php echo '["' . implode('", "', $deptEmpArr) . '"]' ?>;

     	var branchArr = <?php echo '["' . implode('", "', $branchArr) . '"]' ?>;
     	var branchEmpArr = <?php echo '["' . implode('", "', $branchEmpArr) . '"]' ?>;


    	var male_total = <?php echo json_encode($maleTotal) ?>;
    	var female_total = <?php echo json_encode($femaleTotal) ?>;
    	
    	var hostelNotStay = <?php echo json_encode($hostelNotStay) ?> ;
    	var hostelStay = <?php echo json_encode($hostelStay) ?> ;


    	const chart = new Chartisan({
		  el: '#chart1',
		  // url: 'https://chartisan.dev/chart/example.json',
		  data: {
			  "chart": { "labels": deptsArr },
			  "datasets": [
			     { "name": "Total ", "values":deptEmpArr }
			   
			  ]
			},
		  hooks: new ChartisanHooks()
		    .beginAtZero()
		    .colors()
		    .title('ဌာနအလိုက်ပြသခြင်း')
		})

		// const piechart = new Chartisan({
		//   el: '#piechart',
		//   data: {
		// 	  "chart": { "labels": deptsArr },
		// 	  "datasets": [
		// 	    { "name": "Total", "values": deptEmpArr }
		// 	  ]
		// 	},
		//   hooks: new ChartisanHooks()
		//     .datasets('doughnut')
		//     .pieColors(),
		// })



    	const fmpie = new Chartisan({
		  el: '#fmpie',
		  data: {
			  "chart": { "labels": ["ကျား", "မ"] },
			  "datasets": [
			    { "name": "စုစုပေါင်း", "values": [male_total,female_total] }
			  ]
			},
		  hooks: new ChartisanHooks()
		    .datasets('doughnut')
		    .pieColors()
		    .title('ကျား/မ အလိုက် ခွဲခြားပြသခြင်း')
		})

		var recovered_count = 4; 
    	var inpatient_count = 4; 
    	var dead_count = 5; 


    const pconchart = new Chartisan({
		  el: '#pconchart',
		  // url: 'https://chartisan.dev/chart/example.json',
		  data: {
			  "chart": { "labels": branchArr },
			  "datasets": [
			    { "name": "စုစုပေါင်း", "values": branchEmpArr }
			  ]
			},
		  hooks: new ChartisanHooks()
		    // .colors(['#20FFFF', '#FD8008','#1F85DE','#DE781F'])
		    .colors()
		    .responsive()
		    .beginAtZero()
		    .legend({ position: 'bottom' })
		    .title('Employes at each Branches')
		})



    // var hostel = <?php echo json_encode($hostel) ?> ;
    // var fmcount =<?php echo json_encode($fmcount) ?> ;
    // var mcount =<?php echo json_encode($mcount) ?> ;


    // const hostelchart = new Chartisan({
    //   el: '#hostelchart',
    //   // url: 'https://chartisan.dev/chart/example.json',
    //   data: {
    //     "chart": { "labels": hostel },
    //     "datasets": [
    //       { "name": "ကျား", "values": mcount },
    //       { "name": "မ", "values": fmcount }
    //     ]
    //   },
    //   hooks: new ChartisanHooks()
    //     // .colors(['#20FFFF', '#FD8008','#1F85DE','#DE781F'])
    //     .colors()
    //     .responsive()
    //     .beginAtZero()
    //     .legend({ position: 'bottom' })
    //     .title('အဆောင်အလိုက် ကျား/မ ပြသမှု')
    // })



    var bhostel = <?php echo json_encode($branchArr) ?> ;
    var bfmcount =<?php echo json_encode($bhMale) ?> ;
    var bmcount =<?php echo json_encode($bhFemale) ?> ;

     const bhchart = new Chartisan({
      el: '#bhchart',
      // url: 'https://chartisan.dev/chart/example.json',
      data: {
        "chart": { "labels": bhostel },
        "datasets": [
          { "name": "ကျား", "values": bmcount },
          { "name": "မ", "values": bfmcount }
        ]
      },
      hooks: new ChartisanHooks()
        // .colors(['#20FFFF', '#FD8008','#1F85DE','#DE781F'])
        .colors()
        .responsive()
        .beginAtZero()
        .legend({ position: 'bottom' })
        .title('ဆိုင်ခွဲအလိုက် အဆောင်နေသူ ကျား/မ')
    })


     
    var brhTotalArr = <?php echo json_encode($brhTotalArr) ?> ;

    const bhPie = new Chartisan({
      el: '#bhPie',
      data: {
         "chart": { "labels": bhostel},
         "datasets": [
          { "name": "", "values": brhTotalArr }
         ]
      },
      hooks: new ChartisanHooks()
        .datasets('doughnut')
        .pieColors()
        .title('ဆိုင်ခွဲအလိုက် အဆောင်နေသူများ')
       
    })


		const pconpie = new Chartisan({
		  el: '#pconpie',
		  data: {
			   "chart": { "labels": ["အဆောင်မနေ","အဆောင်နေ"] },
			   "datasets": [
			    { "name": "", "values": [hostelNotStay,hostelStay] }
			   ]
			},
		  hooks: new ChartisanHooks()
		    .datasets('doughnut')
		    .pieColors()
		    .title('အဆောင်နေ/မနေ')
		   
		})


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
                // $(this).html('<center><a href="{{ route("employee.index") }}" style="text-decoration:none"><h2 style="margin-top:40px; width:150px"></h2></a></center>');
                // $(this).css('background', '#fdf');
                // $(this).css('cursor', 'pointer');
            }
        });

        $('#calendar').delegate('.fc-day a', 'mouseover', function(){
         // alert("a mouseover");
        });

        $('#calendar').delegate('.fc-day', 'mouseout', function(){
            $(this).html('');
            $(this).css('background', '#ffffff');
        });

        // $('#calendar').delegate('.fc-day', 'click', function(){
        //     href = $(this).find('a').attr('href');
        //     if(href==undefined){
        //         return false;
        //     }
        //     window.location.href=$(this).find('a').attr('href');
        // });
    });

    $(function() {
          $('div').on("click", "div.div-click", function() {

            window.location = $(this).data("url");
          });
        });
    </script>
@stop