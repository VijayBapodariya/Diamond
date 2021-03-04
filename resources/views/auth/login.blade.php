@extends('layout.master2')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">

  <div class="row w-100 mx-0 auth-page">
    <div class="col-md-8 col-xl-6 mx-auto">
      <div class="card">
        <div class="row">
          <div class="col-md-12">
            <div class="auth-form-wrapper px-5 py-5">
                <img src="{{ url('favicon.ico') }}" class="img-responsive mx-auto d-block" style="width:100px;"  />
              <a href="#" class="noble-ui-logo d-block mb-2 text-center">Diamond<span>Coupon</span></a>
              <h5 class="text-muted font-weight-normal mb-4 text-center">Welcome back! Log in to your account.</h5>
              @if(Session::has('msg'))
                <div class="alert alert-danger" role="alert">
                  {{ Session::has('msg') ? Session::get("msg") : '' }}
                </div>
              @endif
              <form class="forms-sample" method="post"   action="{{ url('/login_custom') }}">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" class="form-control @error('userName') is-invalid @enderror" name="userName" value="{{Old('userName')}}" id="exampleInputEmail1" placeholder="Username">
                  @error('userName')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="exampleInputPassword1" autocomplete="current-password" placeholder="Password">
                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input">
                    Remember me
                  </label>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0">Login</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection