@extends('adminlte::page')

@section('title', 'Organization Chart')

@section('content_header')
    <h5 style="color: blue;" class="unicode">Organization Chart</h5>
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
    <div id="chart-container"></div>
  </div>
</div>
 	
@stop


@section('css')
<link rel="stylesheet" href="{{ asset('css/jquery.orgchart.css')}}">
<style>
  #chart-container {
    position: relative;
    height: 420px;
    border: 1px solid #aaa;
    margin: 0.5rem;
    overflow: auto;
    text-align: center;
  }

  .orgchart { 
    background: #fff; 
    width: auto; 
    height:100%; 
  }
  .orgchart td.left, .orgchart td.right, .orgchart td.top { border-color: #aaa; }
  .orgchart td>.down { background-color: #aaa; }
  .orgchart .middle-level .title { background-color: #006699; }
  .orgchart .middle-level .content { border-color: #006699; }
  .orgchart .product-dept .title { background-color: #009933; }
  .orgchart .product-dept .content { border-color: #009933; }
  .orgchart .rd-dept .title { background-color: #993366; }
  .orgchart .rd-dept .content { border-color: #993366; }
  .orgchart .pipeline1 .title { background-color: #996633; }
  .orgchart .pipeline1 .content { border-color: #996633; }
  .orgchart .frontend1 .title { background-color: #cc0066; }
  .orgchart .frontend1 .content { border-color: #cc0066; }
  .orgchart .supervisor-lv .title { background-color: #AE38FF; }
  .orgchart .supervisor-lv .content { border-color: #AE38FF; }
</style>
@stop

@section('js')
  <script type="text/javascript" src="{{ asset('js/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.orgchart.js')}}"></script>
  <script type="text/javascript">
     $(function() {

          var datascource = {
            'name': 'U Nay Linn Htike',
            'title': 'Managing Director',
            'className':'middle-level',
            'children': [
              { 'name': 'U Aung Min Htwe', 'title': 'Director', 'className': 'director-level',
                'children': [
                  { 'name': 'Daw Pyone Thandar Win', 'title': 'General Manager', 'className': 'product-dept',
                    'children': [
                      { 'name': 'Daw Moe Thuzar Kyaw', 'title': 'Manager', 'className': 'pipeline1',
                        'children': [
                            { 'name': 'Aye Nandar Kayw', 'title': 'Supervisor', 'className': 'supervisor-lv' }
                          ]
                      },
                      { 'name': 'Daw Nyein Su Su Tun', 'title': 'Manager', 'className': 'pipeline1',
                        'children': [
                            { 'name': 'Thawdar Lin', 'title': 'Supervisor', 'className': 'supervisor-lv' },
                            { 'name': 'Yi Mon Theint', 'title': 'Supervisor', 'className': 'supervisor-lv' },
                            { 'name': 'Ingyin Khaing', 'title': 'Supervisor', 'className': 'supervisor-lv' },
                            { 'name': 'Ei Ei Khaing', 'title': 'Supervisor', 'className': 'supervisor-lv' }
                          ]
                      },
                      { 'name': 'Daw Phyu Phyu Aye', 'title': 'Manager', 'className': 'pipeline1',
                        'children': [
                            { 'name': 'Daw Thiri Htet Ko', 'title': 'Supervisor', 'className': 'supervisor-lv' }
                          ] 
                      }
                    ]
                  },
                  { 'name': 'U Zaw Naing Htwe', 'title': 'General Manager', 'className': 'product-dept',
                    'children': [
                      { 'name': 'U Min Min', 'title': 'Manager', 'className': 'pipeline1',
                        'children': [
                            { 'name': 'Thet Naung Soe', 'title': 'Supervisor', 'className': 'supervisor-lv' },
                            { 'name': 'U Zaw Nay Aung', 'title': 'Supervisor', 'className': 'supervisor-lv' },
                            { 'name': 'Ye Thwin Oo', 'title': 'Supervisor', 'className': 'supervisor-lv' },
                            { 'name': 'Khon Ye Aye', 'title': 'Supervisor', 'className': 'supervisor-lv' },
                            { 'name': 'Moe Thiha', 'title': 'Supervisor', 'className': 'supervisor-lv' }
                          ]
                      },
                      { 'name': 'U Thein Htike San', 'title': 'Manager', 'className': 'pipeline1',
                        'children': [
                            { 'name': 'Aung Pyae Sone', 'title': 'Supervisor', 'className': 'supervisor-lv' },
                            { 'name': 'Ye Naing Soe', 'title': 'Supervisor', 'className': 'supervisor-lv' },
                            { 'name': 'Aung Soe Oo', 'title': 'Supervisor', 'className': 'supervisor-lv' }
                          ]
                      },
                      { 'name': 'U Kyi Myint','title': 'HR Manager', 'className': 'pipeline1',
                          'children': [
                            { 'name': 'Si Thu Hein', 'title': 'Supervisor', 'className': 'supervisor-lv' }
                          ] 
                      }
                    ]
                  },
                  { 'name': 'U Khon Hein Min Naing', 'title': 'General Manager', 'className': 'product-dept',
                    'children': [
                        { 'name': 'Daw Thiyi Aung', 'title': 'Manager', 'className': 'pipeline1' },
                      ] 
                  }
                ]
              },
              { 'name': 'U Min Min Htun', 'title': 'Director', 'className': 'director-level',
                'children': [
                  { 'name': 'Daw San Naing', 'title': 'General Manager', 'className': 'rd-dept',
                    'children': [
                      { 'name': 'U Ye Htut Aung', 'title': 'Manager','className': 'frontend1' }
                    ]
                  }
                ]
              }
            ]
          };

          $('#chart-container').orgchart({
            'data' : datascource,
            'nodeContent': 'title'
          });

  });

  </script>
@stop