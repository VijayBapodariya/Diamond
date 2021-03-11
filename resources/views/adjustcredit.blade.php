@extends('layout.master')

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
            <h6>Credit Adjust</h6>
        </div>
      <div class="card-body">
        @if(Session::has('msg'))
            <div class="alert alert-danger" role="alert">
            {{ Session::has('msg') ? Session::get("msg") : '' }}
            </div>
        @elseif(Session::has('success'))
           <div class="alert alert-success" role="alert">{{Session::get("success")}}</div>
        @endif

        <form method="post" action="{{ url('adjustcredit/'.$data['_id'])}}">
            @csrf
          <div class="form-group d-flex">
            <div class="col-sm-6 offset-lg-3">
                <h4 class="breadcrumb bg-light">User: {{$data['userName']}}</h4><br>
                <h4 class="breadcrumb bg-light">Credits: {{number_format($data['creditPoint'],2)}}</h4>
            </div>
            <div class="col-sm-6">
                @if(Session::get('role') != "Admin")
                    <h4 class="breadcrumb bg-light">Credits available: {{number_format(Session::get('creditPoint'),2)}}</h4><br>
                @endif
            </div>
          </div>
          <div class="form-group d-flex">
            <label class="col-sm-2 offset-lg-1 text-right control-label mt-2">Amount to Adjust</label>
            <div class="col-sm-6">
                <input type="number" class="form-control ui-autocomplete-input @error('amount') is-invalid @enderror" id="exampleInputUsername1"  value="{{Old('amount')}}" name="amount" autocomplete="off">
                <input type="hidden" value="{{$data['_id']}}" name="id" autocomplete="off">
                @error('amount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
          </div>
          <div class="form-group d-flex">
            <label class="col-sm-2 offset-lg-1 text-right control-label mt-2">Transaction Password</label>
            <div class="col-sm-6">
                <input type="password" class="form-control ui-autocomplete-input @error('password') is-invalid @enderror" id="exampleInputUsername1" value="{{Old('password')}}" name="password" autocomplete="off">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
          </div>
          <div class="form-group d-flex">
            <label class="col-sm-2 offset-lg-1 text-right control-label mt-2"></label>
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary">Adjust Credit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection