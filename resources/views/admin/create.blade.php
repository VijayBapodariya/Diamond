@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
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
            <h6>Add User</h6>
        </div>
      <div class="card-body">
        <form method="post" action="{{ url('/admin')}}">
            @csrf
            {{-- @if(Session::has('error'))
                <div class="alert alert-danger" role="alert">{{Session::get("error")}}</div>
            @elseif(Session::has('success'))
                <div class="alert alert-success" role="alert">{{Session::get("success")}}</div>
            @endif --}}
          {{-- <div class="form-group d-flex">
            <label class="col-sm-2 offset-lg-1 text-right control-label mt-2">Username</label>
            <div class="col-sm-6"> --}}
                <input type="hidden" class="form-control ui-autocomplete-input @error('username') is-invalid @enderror" id="exampleInputUsername1" value="0" name="username" autocomplete="off" placeholder="Plz Enter Username">
                  {{-- @error('username')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
            </div>
          </div> --}}
          <div class="form-group d-flex">
            <label class="col-sm-2 offset-lg-1 text-right control-label mt-2">Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control ui-autocomplete-input @error('name') is-invalid @enderror" id="exampleInputUsername1" value="{{Old('name')}}" name="name" autocomplete="off" placeholder="Plz Enter Name">
                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
            </div>
          </div>
          <div class="form-group d-flex">
            <label class="col-sm-2 offset-lg-1 text-right control-label mt-2">Firm Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control ui-autocomplete-input @error('firmName') is-invalid @enderror" id="exampleInputUsername1" value="{{Old('firmName')}}" name="firmName" autocomplete="off" placeholder="Plz Enter firmName">
                  @error('firmName')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
            </div>
          </div>
          <div class="form-group d-flex">
            <label class="col-sm-2 offset-lg-1 text-right control-label mt-2">Role</label>
            <div class="col-sm-6">
                <div class="form-group mb-2">
                    <select class="form-control" name="role" id="role">
                        <option selected disabled>Select Role</option>
                        <option value="1">Admin</option>
                        <option value="3">Super Distributer</option>
                        <option value="5">Distributer</option>
                        <option value="7">Retailer</option>
                    </select>
                </div>
                  @error('role')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
            </div>
          </div>
          <div class="form-group d-flex" id="referral2">
            <label class="col-sm-2 offset-lg-1 text-right control-label mt-2" id="s1">Super Distributer</label>
            <div class="col-sm-6" id="s2">
                <div class="form-group mb-2">
                    <select class="form-control superDistributerId" name="superDistributerId" id="superDistributerId">
                        <option selected disabled>Select SuperDistributer</option>
                    </select>
                </div>
                  @error('superDistributer')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
            </div>
          </div>
            <div class="form-group d-flex" id="referral">

            </div>
          <div class="form-group d-flex">
            <label class="col-sm-2 offset-lg-1 text-right control-label mt-2">Password</label>
            <div class="col-sm-6">
                <input type="number" class="form-control ui-autocomplete-input @error('password') is-invalid @enderror" id="exampleInputUsername1" maxlength="5" minlength="5" value="{{Old('password')}}" name="password" autocomplete="off" placeholder="Plz Enter Password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
          </div>
          <div class="form-group d-flex">
            <label class="col-sm-2 offset-lg-1 text-right control-label mt-2">Transaction Pin</label>
            <div class="col-sm-6">
                <input type="number" class="form-control ui-autocomplete-input @error('transactionPin') is-invalid @enderror" id="exampleInputUsername1" value="{{Old('transactionPin')}}" name="transactionPin" autocomplete="off" placeholder="Plz Enter Transaction Pin">
                @error('transactionPin')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
          </div>
          <div class="form-group d-flex">
            <label class="col-sm-2 offset-lg-1 text-right control-label mt-2">Commission Percentage</label>
            <div class="col-sm-6">
                <input type="text" class="form-control ui-autocomplete-input @error('commissionPercentage') is-invalid @enderror" id="exampleInputUsername1" value="{{Old('commissionPercentage')}}" name="commissionPercentage" autocomplete="off" placeholder="Plz Enter CommissionPercentage">
                @error('commissionPercentage')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
          </div>
          <div class="form-group d-flex">
            <label class="col-sm-2 offset-lg-1 text-right control-label mt-2">Page Permission</label>
            <div class="col-sm-6">
                <input type="text" class="form-control ui-autocomplete-input @error('sharingPercentage') is-invalid @enderror" id="exampleInputUsername1" value="{{Old('sharingPercentage')}}" name="sharingPercentage" autocomplete="off" placeholder="Plz Enter sharingPercentage">
                @error('sharingPercentage')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
          </div>
          <div class="form-group d-flex" id="perissions">
              <label class="col-sm-2 offset-lg-1 text-right control-label mt-2">Sharing Percentage</label>
              <div class="col-sm-3">
                <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="permission[]" value="full_permission">
                    Full_Permission
                  </label>
                </div>
                <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="permission[]" value="add_user">
                    Add User
                  </label>
                </div>
                <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="permission[]" value="view_user">
                    View User
                  </label>
                </div>
                <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="permission[]"  value="superdistributer">
                    Superdistributer
                  </label>
                </div>
                <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="permission[]"  value="distributer">
                    Distributer
                  </label>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="permission[]"  value="retailer">
                    Retailer
                  </label>
                </div>
                <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="permission[]"  value="winningPercent">
                    WinningPercent
                  </label>
                </div>
                <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="permission[]"  value="winbyadmin">
                    Winbyadmin
                  </label>
                </div>
                <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="permission[]"  value="announcement">
                    Announcement
                  </label>
                </div>
                <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="permission[]"  value="complaint">
                    Complaint
                  </label>
                </div>
              </div>
          </div>
          <div class="form-group d-flex">
            <label class="col-sm-2 offset-lg-1 text-right control-label mt-2"></label>
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/prismjs/prism.js') }}"></script>
  <script src="{{ asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script type="text/javascript">
      $(document).ready(function(){
        $('#role').change(function(){
          var Role = $(this).val();
          // alert(Role);
          var uri;
          if(parseInt(Role) == 1){
              $('#s1').hide();
              $('#s2').hide();
              $('#s1').closest('.form-group').css('margin-bottom', '0px');
              uri = "{{url('/get_data')}}";
              var token = $('input[name="_token"]').val();
              $.ajax({
                  url: uri,
                  type:'POST',
                  data:{
                      role:Role,
                      _token:token
                  },
                  success:function(res)
                  {
                    $('#referral').html(res);
                    $('#perissions').show();
                  }
              });
          }else if(parseInt(Role) == 3){
              $('#s1').hide();
              $('#s2').hide();
              $('#s1').closest('.form-group').css('margin-bottom', '0px');
              uri = "{{url('/get_data')}}";
              var token = $('input[name="_token"]').val();
              $.ajax({
                  url: uri,
                  type:'POST',
                  data:{
                      role:Role,
                      _token:token
                  },
                  success:function(res)
                  {
                    $('#referral').html(res);
                  }
              });
          }else if(parseInt(Role) == 5){
              $('#s1').hide();
              $('#s2').hide();
              $('#s1').closest('.form-group').css('margin-bottom', '0px');
              uri = "{{url('/get_data')}}";
              var token = $('input[name="_token"]').val();
              $.ajax({
                  url: uri,
                  type:'POST',
                  data:{
                      role:Role,
                      _token:token
                  },
                  success:function(res)
                  {
                    $('#referral').html(res);
                  }
              });
          }else if(parseInt(Role)==7){
              $('#s1').show();
              $('#s2').show();
              $('#s1').closest('.form-group').css('margin-bottom', '5px');
              uri = "{{url('/get_data')}}";
              var token = $('input[name="_token"]').val();
              $.ajax({
                    url: uri,
                    type:'POST',
                    data:{
                        role:Role,
                        _token:token
                    },
                    success:function(res)
                    {
                      $('.superDistributerId').html(res);
                    }
              });
          }
         
        
          $('#superDistributerId').change(function(){
            var id = $(this).val();
            var token = $('input[name="_token"]').val();
            $.ajax({
                  url: "{{url('/get_distributer')}}",
                  type:'POST',
                  data:{
                      role:id,
                      _token:token
                  },
                  success:function(res)
                  {
                      $('#referral').html(res);
                  }
              });
          });
        });
      });
    </script>
@endpush