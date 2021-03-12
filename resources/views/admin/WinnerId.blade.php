@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
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
            <h6>Retialer By Admin</h6>
        </div>
        <div class="card-body">
            
            <form method="post" action="{{ url('/winnerIdAdmin') }}">
                @csrf
                @if(Session::has('error'))
                    <div class="alert alert-danger" role="alert">{{Session::get("error")}}</div>
                @elseif(Session::has('success'))
                    <div class="alert alert-success" role="alert">{{Session::get("success")}}</div>
                @endif
                <div class="form-group d-flex">
                    <label class="col-sm-2 offset-lg-1 text-right control-label mt-2">Username :</label>
                    <div class="col-sm-6">
                        <select class="js-example-basic-single w-100" name="amount" id="select">
                          <option value="-1">Enter the UserName</option>
                          @foreach($data as $value)
                              <option value="{{$value['_id']}}">{{$value['userName']}}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group d-flex">
                    <label class="col-sm-2 offset-lg-1 text-right control-label mt-2">Win Percent</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control ui-autocomplete-input @error('percent') is-invalid @enderror" id="exampleInputUsername1"  value="{{Old('percent')}}" name="percent" autocomplete="off" placeholder="Plz Enter percent">
                        @error('percent')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group d-flex">
                    <div class="col-sm-2 offset-lg-3">
                        <input class="btn btn-primary" type="submit" value="Submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Winner By Admin</h6>
        <div class="table-responsive">
            <table id="dataTableExample" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Sl no.</th>
                  <th>Username</th>
                  <th>Percent</th>
                  <th>Date </th>
                </tr>
              </thead>
              <tbody>
                  @php $no = 1; $d=0; $c=0; @endphp 
                @foreach($winner as $pay)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$pay['userName']}}</td>
                        <td>{{$pay['percent']}}</td>
                        <td>{{\Carbon\Carbon::parse($pay['createdAt'])->format('d-m-Y h:i:s A') }}</td>
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
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
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