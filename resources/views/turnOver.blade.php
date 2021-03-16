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
            <div class="col-sm-8 mt-2">
                <div class="btn-group">
                    @php
                      $mon = strtotime("last monday");
                      $monday = date('W', $mon)==date('W') ? $mon-7*86400 : $mon;
                      $sunday = strtotime(date("Y-m-d",$monday)." +6 days");
                      $week_sd = date("Y-m-d",$monday);
                      $week_ed = date("Y-m-d",$sunday);
                      // die();
                    @endphp
                    <a href="{{url('Tnover/1/'.date("Y-m-d", strtotime("-6 month")).'/'.date('Y-m-d'))}}" class="btn btn-outline-info">Last 6 Months</a>
                    <a href="{{url('Tnover/2/'.date("Y-m-01").'/'.date('Y-m-t'))}}" class="btn btn-outline-info">Current Month</a>
                    <a href="{{url('Tnover/3/'.date("Y-m-d", strtotime("first day of last month")).'/'.date("Y-m-d", strtotime("last day of last month")))}}" class="btn btn-outline-info">Last Month</a>
                    <a href="{{url('Tnover/4/'.$week_sd.'/'.$week_ed)}}" class="btn btn-outline-info">Last Week</a>
                    <a href="{{url('Tnover/5/'.date("Y-m-d", strtotime("monday")).'/'.date('Y-m-d', strtotime('+'.(7-date('w')).' days')))}}" class="btn btn-outline-info">Current Week</a>
                    <a href="{{url('Tnover/6/'.date("Y-m-d", strtotime("-1 day")).'/'.date("Y-m-d", strtotime("-1 day")))}}" class="btn btn-outline-info">Yesterday</a>
                    <a href="{{url('Tnover/7/'.date('Y-m-d').'/'.date('Y-m-d'))}}" class="btn btn-outline-info">Today</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="breadcrumb bg-light" id="live2">
                <div class="col-sm-3 text-center">
                    Total Play Points<br> <span>{{number_format($total['totalPlayPoints'],2)}}</span>
                </div>
                <div class="col-sm-3 text-center">
                    Total Win Points <br> <span>{{number_format($total['TotalWinPoints'],2)}}</span>
                </div>
                <div class="col-sm-3 text-center">
                    End Point <br> <span>{{number_format($total['EndPoint'],2)}}</span>
                </div>
                <div class="col-sm-3 text-center">
                    Total Retailer Commission <br> <span>{{number_format($total['TotalRetailerCommission'],2)}}</span>
                </div>
                {{-- <div class="col-sm-3 text-center">	
                    Total Commission <br> <span>{{number_format($total['TotalCommission']}}</span>                  
                </div> --}}
                
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
                  <th>Play Points</th>
                  <th>Win Points</th>
                  <th>End Point</th>
                  <th>Super Distributer Commission</th>
                  <th>Distributer Commission</th>
                  <th>Retailer Commission</th>
                  <th>Type</th>
                </tr>
              </thead>
              <tbody>
                @php $no = 1 @endphp
                @foreach($data as $play)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$play['userName']}}</td>
                  <td>{{number_format($total['totalPlayPoints'],2)}}</td>
                  <td>{{number_format($total['TotalWinPoints'],2)}}</td>
                  <td>{{number_format($total['EndPoint'],2)}}</td>
                  <td>{{number_format($total['TotalSuperDistributerCommission'],2)}}</td>
                  <td>{{number_format($total['TotalDistributerCommission'],2)}}</td>
                  <td>{{number_format($total['TotalRetailerCommission'],2)}}</td>
                  <td>TN</td>
                </tr>
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
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
