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
        <div class="card-header">
            <h6>Winning Percentage</h6>
        </div>
      <div class="card-body">
        <form method="post" action="{{ url('/percent')}}">
            @csrf
            @php
              date_default_timezone_set("Asia/Calcutta");
              $startTime = date('H:i',strtotime("9:00:00 pm")). "<br>";
              $endTime = date('H:i',strtotime("7:00:00 am")). "<br>";
              $time = date('H:i',time()) . "<br>";
            @endphp
          @if($startTime < $time && $time < $endTime)
              <div class="form-group d-flex">
                <label class="col-sm-2 offset-lg-1 text-right control-label mt-2">Winning Percentage</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control ui-autocomplete-input @error('percent') is-invalid @enderror" id="exampleInputUsername1" value="{{$data['percent']}}" name="percent" autocomplete="off" placeholder="Plz Enter Percentage">
                      @error('percent')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                </div>
              </div>
              <div class="form-group d-flex">
                <label class="col-sm-2 offset-lg-1 text-right control-label mt-2"></label>
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary">Set Percentage</button>
                </div>
              </div>
          @else
            <div class="form-group d-flex">
              <label class="col-sm-2 offset-lg-1 text-right control-label mt-2">Winning Percentage</label>
              <div class="col-sm-6">
                  <input type="number" class="form-control ui-autocomplete-input @error('percent') is-invalid @enderror" id="exampleInputUsername1" value="{{$data['percent']}}" name="percent" autocomplete="off" placeholder="Plz Enter Percentage" disabled>
                    @error('percent')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              </div>
            </div>
          @endif
          
        </form>
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