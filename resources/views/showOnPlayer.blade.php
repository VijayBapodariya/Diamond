@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
@endpush

@section('content')
{{-- <nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Forms</a></li>
    <li class="breadcrumb-item active" aria-current="page">Basic Elements</li>
  </ol>
</nav> --}}

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header d-flex">
            <h5 class="col-sm-8 mt-2">Today's Summary ( {{  date('d-m-Y')  }} )</h5>
            <div id="clock" class="col-sm-4 text-center" style="font-size: 20px;">13:40:09</div>
        </div>
        <div class="card-body">
            <div class="breadcrumb bg-light" id="live2">
                <div class="col-sm-3 text-center">
                    Total Play Points<br> <span></span>
                </div>
                <div class="col-sm-3 text-center">
                    Total Win Points <br> <span></span>
                </div>
                <div class="col-sm-3 text-center">
                    End Point <br> <span>0</span>
                </div>
                <div class="col-sm-3 text-center">	
                    Distributor Commission <br> <span></span>                  
                </div>
                <div class="col-sm-2 text-center">
                    <!--Total Profit <br> <span>0</span>-->	
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Online Players</h6>
        <div class="table-responsive">
            <table id="dataTableExample" class="table table-bordered">
              <thead>
                <tr>
                  <th>Sno</th>
                  <th>Username</th>
                  <th>Name</th>
                  <th>Distributor</th>
                  <th>Credit</th>
                  <th>Play Points</th>
                  <th>Win Points</th>
                  <th>End Point</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $sl_no = 1;
                @endphp
                @foreach($data as $value)
                    @if($value['referralId']==Session::get('id') || Session::get('role')=="s")
                        @foreach($users as $user)
                            @if($value['isLogin']==true)
                            @if($value['referralId'] == $user['_id'] )
                                <tr role="row" class="odd">
                                    <td class=""><?= $sl_no++; ?></td>
                                    <td><a href="{{ url('detail/'.$value['_id']) }}">{{$value['userName']}}<i class="mdi mdi-eye"></i></a></td>
                                    <td>{{$value['name']}}</td>
                                    <td class="sorting_1">
                                        {{$user['userName']}}
                                    </td>
                                    <td>{{number_format($value['creditPoint'],2)}}</td>
                                    <td>{{number_format($point['betPoint'],2)}}</td>
                                    <td>{{number_format($point['wonPoint'],2)}}</td>
                                    <td>{{number_format($point['endPoint'],2)}}</td>
                                </tr>
                            @endif
                            @endif
                        @endforeach
                    @endif
                @endforeach
              </tbody>  
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/promise-polyfill/polyfill.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
          startTime();
          function startTime() {
              var today = new Date();
              var h = today.getHours();
              var m = today.getMinutes();
              var s = today.getSeconds();
              m = checkTime(m);
              s = checkTime(s);
              $('#clock').html(h + ":" + m + ":" + s);
              setTimeout(startTime, 1000);
          }
          function checkTime(i) {
              if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
              return i;
          }
        });
    </script>
@endpush