@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
{{-- <nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Forms</a></li>
    <li class="breadcrumb-item active" aria-current="page">Basic Elements</li>
  </ol>
</nav> --}}

{{-- <div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <form  id="myFormID" action="{{ url('/transaction') }}">
                @csrf
                <div class="forms-sample">
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <div class="input-group date datepicker" id="datePickerExample">
                                <input type="text" class="form-control" name="from" placeholder="From"><span class="input-group-addon"><i data-feather="calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-1 text-center mt-2">To</div>
                        <div class="col-sm-4">
                            <div class="input-group date datepicker" id="datePickerExample1">
                                <input type="text" class="form-control" name="to" placeholder="To"><span class="input-group-addon"><i data-feather="calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <input class="btn btn-primary form-control" type="submit" value="Submit">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</div> --}}

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Commission Payment Report</h6>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                    <th>Id</th>
                    <th>Date</th>
                    <th>Username</th>
                    <th>User Type</th>
                    <th>Name</th>
                    @if(Session::get('role')=="Admin")
                    <th>SuperDistributer</th>
                    @endif
                    @if(Session::get('role')=="superDistributer" || Session::get('role')=="Admin")
                    <th>Distributer</th>
                    @endif
                    @if(Session::get('role')=="superDistributer" || Session::get('role')=="Admin" || Session::get('role')=="distributer")
                    <th>Retailer/Player</th>
                    @endif
                    @if(Session::get('role')=="Admin")
                    <th>SuperDistributer Amount</th>
                    @endif
                    @if(Session::get('role')=="superDistributer" || Session::get('role')=="Admin")
                      <th>Distributer Amount</th>
                    @endif
                    <th>Retailer Amount</th>
                </tr>
              </thead>
              <tbody>		
                @php $no =1; $totalS = 0; $totalD = 0; $totalR = 0;@endphp
                @foreach($data as $day => $value)			    						      
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$day}}</td>
                    <td>{{$value['userName']}}</td>
                    <td>{{$value['role']}}</td>
                    <td>{{$value['name']}}</td>
                    @if(Session::get('role')=="Admin")
                      <td>{{$value['super']}}</td>
                    @endif
                    @if(Session::get('role')=="superDistributer" || Session::get('role')=="Admin")
                      <td>{{$value['dis']}}</td>
                    @endif
                    @if(Session::get('role')=="superDistributer" || Session::get('role')=="Admin" || Session::get('role')=="distributer")
                      <td>{{$value['retailer']}}</td>
                    @endif
                    @if(Session::get('role')=="Admin")
                      <td>{{$totalS += number_format($value['TotalSuperDistributerCommission'],2)}}</td>
                    @endif
                    @if(Session::get('role')=="superDistributer" || Session::get('role')=="Admin")
                      <td>{{$totalD += number_format($value['TotalDistributerCommission'],2)}}</td>
                    @endif
                    <td>{{$totalR += number_format($value['TotalRetailerCommission'],2)}}</td>
                </tr>
                @endforeach
                                                
                <tr>
                    <td></td>
                    <td colspan="2">Total Commission</td>
                    <td></td>
                    <td></td>
                    @if(Session::get('role')=="superDistributer" || Session::get('role')=="Admin" || Session::get('role')=="distributer")
                    <td></td>
                    @endif
                    @if(Session::get('role')=="superDistributer" || Session::get('role')=="Admin")
                    <td></td>
                    @endif
                    @if(Session::get('role')=="Admin")
                    <td></td>
                    <td>{{$totalS}}</td>
                    @endif
                    @if(Session::get('role')=="superDistributer" || Session::get('role')=="Admin")
                    <td>{{$totalD}}</td>
                    @endif
                    <td>{{$totalR}}</td>
                </tr>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>




@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#myFormID").submit(function(e) {
        e.preventDefault(); // prevent actual form submit
        var form = $(this);
        var url = form.attr('action'); //get submit url [replace url here if desired]
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes form input
            success: function(data){
                console.log(data);
            }
        });
      });
    });
  </script>
@endpush