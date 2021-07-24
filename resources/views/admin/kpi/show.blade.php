@extends('adminlte::page')
@section('title', 'KPI Detail')
@section('content_header')
<div class="row">
<?php
  $year = isset($_GET['year'])?$_GET['year']:date('Y');
?>    

  <div class="col-md-2">
       <a class="btn btn-primary unicode" href="{{route('kpi.index')}}"> Back</a>
  </div>
  <div class="col-md-8 text-center">
       <h5 style="color: blue;" class="unicode">KPI Detail</h5><br>
       <div class="row">
          <div class="col-md-6 text-right">
            @if($kpi->employee->photo == '')
              <img src="{{ asset('uploads/employeePhoto/default.png') }}" alt="photo" width="100px" height="120px">
            @else
              <img src="{{ asset('uploads/employeePhoto/'.$kpi->employee->photo) }}" alt="photo" width="100px" height="120px">
            @endif
          </div>
          <div class="col-md-6 text-left">
               {{ $kpi->employee->name }} <br>
               {{ $kpi->employee->viewDepartment->name }} <br>
               {{ $kpi->employee->viewPosition->name }} <br>
               {{ $kpi->employee->viewBranch->name }}
          </div>
      </div>
  </div>
  <div class="col-md-2 text-right"> 
  </div>

</div>
<br>
@stop
@section('content')
<div >
  <div class="row">
      <div class="col-md-2 text-right">
          <form action="{{route('kpi.show',$kpi->id)}}" method="get" accept-charset="utf-8" class="form-horizontal">
               <input type="text" name="year" id="year"class="form-control unicode" placeholder="2021" value="{{ old('year',$year) }}" style="font-size: 13px; width: 50%">
          </form>
         
      </div>
      <div class="col-md-12">
          <div id="kpiChart" style="height: 300px;"></div>
      </div>  
  </div>
  <hr>
  <br>
  <div class="row">
         @php
            $kpiArr = ['Poor','Bad','Average','Good','Excellent'];
            $colorArr = ['#FC0107','#FD8008','#0576f4','#00A825','#21FF06'];

            $totalpoint = 0;
            $totalpoint = $kpi->knowledge + $kpi->descipline + $kpi->skill_set + $kpi->team_work + $kpi->social + $kpi->motivation; 
          @endphp

          <div class="row ">
            <div class="com-md-12 text-center">
                @foreach($kpiArr as $i=>$label)
                  &nbsp;&nbsp;<button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;"> {{++$i}} = {{ $label }}</button>&nbsp;&nbsp;&nbsp;
                @endforeach
            </div>
          </div>
          <br>
          <br>

          <div class="table-responsive" style="font-size:14px">
                <table class="table table-bordered styled-table">
                  <thead>
                    <tr> 
                      <th>No</th>
                      <th>Date</th>
                      <th>Knowledge</th>
                      <th>Discipline</th>
                      <th>Skill Set</th>
                      <th>Team Work</th>
                      <th>Social</th>
                      <th>Motivation</th>
                      <th>Total Point</th>
                      <th>Comment</th>
                    </tr>
                  </thead>
                    <tbody>
                    @if($kpis->count()>0)
                      @foreach($kpis as $i=>$kpi)

                        @php
                          $totalpoint = 0;
                          $totalpoint = $kpi->knowledge + $kpi->descipline + $kpi->skill_set + $kpi->team_work + $kpi->social + $kpi->motivation; 
                        @endphp

                        <tr class="table-tr" data-url="{{route('kpi.show',$kpi->id)}}">
                          <td>{{++$i}}</td>
                          @php 
                            $date = $kpi->year .'-'. $kpi->month;
                          @endphp
                          <td>{{ date('M Y',strtotime($date)) }}</td>
                            <td> 
                              @foreach($kpiArr as $i=>$label) 
                                @php $j = $i +1; @endphp
                                @if($j==$kpi->knowledge)
                                  <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;">{{ $label }}</button>
                                @endif
                              @endforeach
                            </td>
                            <td>
                              @foreach($kpiArr as $i=>$label) 
                                @php $j = $i +1; @endphp
                                @if($j==$kpi->descipline)
                                  <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;">{{ $label }}</button>
                                @endif
                              @endforeach
                            </td>
                            <td>
                              @foreach($kpiArr as $i=>$label) 
                                @php $j = $i +1; @endphp
                                @if($j==$kpi->skill_set)
                                  <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;">{{ $label }}</button>
                                @endif
                              @endforeach
                            </td>
                            <td>
                              @foreach($kpiArr as $i=>$label) 
                                @php $j = $i +1; @endphp
                                @if($j==$kpi->team_work)
                                  <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;">{{ $label }}</button>
                                @endif
                              @endforeach
                            </td>
                            <td>
                              @foreach($kpiArr as $i=>$label) 
                                @php $j = $i +1; @endphp
                                @if($j==$kpi->social)
                                  <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;">{{ $label }}</button>
                                @endif
                              @endforeach
                            </td>
                            <td>
                              @foreach($kpiArr as $i=>$label) 
                                @php $j = $i +1; @endphp
                                @if($j==$kpi->motivation)
                                  <button class="btn btn-sm" style="background-color:{{ $colorArr[$i]  }}; color: black; height: 30px;">{{ $label }}</button>
                                @endif
                              @endforeach
                            </td>
                            <td style="text-align: right;">{{ $totalpoint }}</td>
                            <td>
                               <button class="btn btn-secondary btn-sm" data-comment="{{ $kpi->comment }}" first-name="Endurance" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                              </button>
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
          </div>
       </div> 
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Comment</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
       <p name="comment"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


@stop 
@section('css')
 <link id="bsdp-css" href="{{ asset('/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet">
@stop
@section('js')
  <script src="{{ asset('/js/bootstrap-datepicker.min.js')}}"></script>
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

      var monthArr = <?php echo '["' . implode('", "', $monthArr) . '"]' ?>;
      var kpi1 = <?php echo '["' . implode('", "', $kpi1) . '"]' ?>;
      var kpi2 = <?php echo '["' . implode('", "', $kpi2) . '"]' ?>;
      var kpi3 = <?php echo '["' . implode('", "', $kpi3) . '"]' ?>;
      var kpi4 = <?php echo '["' . implode('", "', $kpi4) . '"]' ?>;
      var kpi5 = <?php echo '["' . implode('", "', $kpi5) . '"]' ?>;
      var kpi6 = <?php echo '["' . implode('", "', $kpi6) . '"]' ?>;

        const kpiChart = new Chartisan({
              el: '#kpiChart',
              data: {
                  "chart": { "labels": monthArr },
                  "datasets": [
                    { "name": "Knowledge", "values": kpi1 },
                    { "name": "Discipline", "values": kpi2 },
                    { "name": "Skill", "values": kpi3 },
                    { "name": "Team Work", "values": kpi4 },
                    { "name": "Social", "values": kpi5 },
                    { "name": "Motivation", "values": kpi6 }
                  ]
                },
              hooks: new ChartisanHooks()
                .colors(['#00ED83','#00FFFF','#800080','#FFFF00','#FF00FF','#800000'])
                .responsive()
                .beginAtZero()
                .legend({ position: 'top' })
                .borderColors()
                .title('KPI by Branch')
        });

      $('#myModal').on('show.bs.modal', function (e) {
        // get information to update quickly to modal view as loading begins
        var opener=e.relatedTarget;//this holds the element who called the modal
         //we get details from attributes
        var cmt=$(opener).attr('data-comment');

      //set what we got to our form
        $('.modal-body').find('[name="comment"]').text(cmt);
         
      });

</script>
@stop
