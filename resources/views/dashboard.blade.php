@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
  </div>
  <div class="d-flex align-items-center flex-wrap text-nowrap">
    <!-- <button type="button" class="btn btn-outline-info btn-icon-text mr-2 d-none d-md-block">
      <i class="btn-icon-prepend" data-feather="download"></i>
      Import
    </button>
    <button type="button" class="btn btn-outline-primary btn-icon-text mr-2 mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="printer"></i>
      Print
    </button>
    <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="download-cloud"></i>
      Download Report
    </button> -->
  </div>
</div>

<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow">
      @if(Session::get('role')=="Admin")
      <div class="col-lg-3 col-md-4 col-sm-4 grid-margin stretch-card">
        <div class="card bg-primary">
          <a href="{{url('/admin')}}">
            <div class="card-body">
              <div class=" row">
                <div class="col-md-8">
                  <h6 class="text-white mb-2">Admin User</h6>
                  <div>
                    <h3 class="text-white">{{$data['users']}}</h3>
                  </div>
                </div>
                <div class="col-md-4 mt-1">
                    <h1 class="text-white text-right mr-3"><i class="fa fa-users"></i></h2>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-md-4 col-sm-4 grid-margin stretch-card">
        <div class="card bg-success">
          <a href="{{url('/superdistributer')}}">
            <div class="card-body">
              <div class=" row">
                <div class="col-md-8">
                  <h6 class="text-white mb-2">SuperDistributer Users</h6>
                  <div>
                    <h3 class="text-white">{{$data['superDistributer']}}</h3>
                  </div>
                </div>
                <div class="col-md-4 mt-1">
                    <h1 class="text-white text-right mr-3"><i class="fa fa-user"></i></h2>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      @endif
      @if(Session::get('role')=="superDistributer" || Session::get('role')=="Admin")
      <div class="col-lg-3 col-md-4 col-sm-4 grid-margin stretch-card">
        <div class="card bg-success">
          <a href="{{url('/distributer')}}">
            <div class="card-body">
              <div class=" row">
                <div class="col-md-8">
                  <h5 class="text-white mb-2">Distributer Users</h5>
                  <div>
                    <h3 class="text-white">{{$data['distributer']}}</h3>
                  </div>
                </div>
                <div class="col-md-4 mt-1">
                    <h1 class="text-white text-right mr-3"><i class="fa fa-user"></i></h2>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      @endif
      <div class="col-lg-3 col-md-4 col-sm-4 grid-margin stretch-card">
        <div class="card bg-info">
          <a href="{{url('/retailer')}}">
            <div class="card-body">
              <div class=" row">
                <div class="col-md-8">
                  <h5 class="text-white mb-2">Retailer Users</h5>
                  <div>
                    <h3 class="text-white">{{$data['retailer']}}</h3>
                  </div>
                </div>
                <div class="col-md-4 mt-1">
                    <h1 class="text-white text-right mr-3"><i class="fa fa-user"></i></h2>
                </div>
              </div>
            </div>
          </>
        </div>
      </div>
      <div class="col-md-3 col-sm-4 grid-margin stretch-card">
        <div class="card bg-danger">
          <a href="{{url('/money/cancel')}}">
            <div class="card-body">
              <div class=" row">
                <div class="col-md-8">
                  <h5 class="text-white mb-2">Money Reqeust Cancel</h5>
                  <div>
                    <h3 class="text-white"><i class="fa fa-inr mr-2"></i></h3>
                  </div>
                </div>
                <div class="col-md-4 mt-1">
                    <h1 class="text-white text-right mr-3"><i class="fa fa-window-close"></i></h2>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card bg-primary">
          <a href="{{url('/money/cancel')}}">
            <div class="card-body">
              <div class=" row">
                <div class="col-md-8">
                  <h5 class="text-white mb-2">Admin Commission</h5>
                  <div>
                    <h3 class="text-white"><i class="fa fa-inr mr-2"></i></h3>
                  </div>
                </div>
                <div class="col-md-4 mt-1">
                    <h1 class="text-white text-right mr-3"><i class="fa fa-money"></i></h2>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/chartjs/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/progressbar-js/progressbar.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
@endpush