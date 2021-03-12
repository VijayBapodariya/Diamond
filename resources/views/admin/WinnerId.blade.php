@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
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
        <div class="card-body">
            <form  id="myFormID" action="{{ url('/transaction') }}">
                @csrf
                <div class="form-group d-flex">
                    <label class="col-sm-1 control-label mt-2">Username :</label>
                    <div class="col-sm-5">
                        <select class="js-example-basic-single w-100" name="amount" id="select">
                          <option value="-1">Enter the UserName</option>
                          @foreach($data as $value)
                              <option value="{{$value['_id']}}">{{$value['userName']}}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group d-flex">
                    <label class="col-sm-1 control-label mt-2">From :</label>
                    <div class="col-sm-5">
                        <div class="input-group date datepicker" id="datePickerExample">
                            <input type="text" class="form-control" name="from"><span class="input-group-addon"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group d-flex">
                    <label class="col-sm-1 control-label mt-2">To :</label>
                    <div class="col-sm-5">
                        <div class="input-group date datepicker" id="datePickerExample1">
                            <input type="text" class="form-control" name="to"><span class="input-group-addon"><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group d-flex">
                    <div class="col-sm-1 offset-sm-1">
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
        <h6 class="card-title">Transactions</h6>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Sl no.</th>
                  <th>Transaction Id</th>
                  <th>Transaction With</th>
                  <th>Credit </th>
                  <th>Debit </th>
                  <th>Balance </th>
                  <th>Date </th>
                  <th>Type </th>
                </tr>
              </thead>
              <tbody>
                  @php $no = 1; $d=0; $c=0; @endphp 
                @foreach($payment as $pay)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$pay['_id']}}</td>
                        <td>{{$pay['userName']}}</td>
                        @if($pay['type']=="adjustment")
                            <td>
                                @if($pay['status']!='pending')
                                    @php $c += $pay['creditPoint']; @endphp
                                @endif
                                {{number_format($pay['creditPoint'])}}
                            </td>
                            <td>
                                --
                            </td>
                        @else
                            <td>
                                --
                            </td>
                            <td>
                                @if($pay['status']!='pending')
                                    @php $d += $pay['creditPoint']; @endphp
                                @endif
                                {{number_format($pay['creditPoint'])}}
                            </td>
                        </td>
                        @endif
                        <td><span class="t2"></span></td>
                        <td>{{\Carbon\Carbon::parse($pay['createdAt'])->format('d-m-Y h:i:s A') }}</td>
                        <td>{{ucfirst($pay['type'])}}<span class="text-success"> {{$pay['status']}}</span></td>
                    </tr>
                @endforeach
                <tr class="highlight">
                  <td>Total</td>
                  <td></td>
                  <td></td>
                  <td>{{$c}}</td>
                  <td>{{$d}}</td>
                  <td></td>
                  <td></td>
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
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/select2.js') }}"></script>
@endpush

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