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
            <h6>Edit User</h6>
        </div>
      <div class="card-body">
        @if(Session::has('msg'))
            <div class="alert alert-danger" role="alert">
            {{ Session::has('msg') ? Session::get("msg") : '' }}
            </div>
        @elseif(Session::has('success'))
           <div class="alert alert-success" role="alert">{{Session::get("success")}}</div>
        @endif
        <form method="post" action="{{ url('admin/'.$edata['_id'])}}">
            @csrf
            @method('PUT')
            {{-- @if(Session::has('error'))
                <div class="alert alert-danger" role="alert">{{Session::get("error")}}</div>
            @elseif(Session::has('success'))
                <div class="alert alert-success" role="alert">{{Session::get("success")}}</div>
            @endif --}}
          {{-- <div class="form-group d-flex">
            <label class="col-sm-2 offset-lg-1 text-right control-label mt-2">Username</label>
            <div class="col-sm-6"> --}}
                <input type="hidden" class="form-control ui-autocomplete-input @error('username') is-invalid @enderror" id="exampleInputUsername1" value="{{$edata['userName']}}" name="username" autocomplete="off" placeholder="Plz Enter Username">
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
                <input type="text" class="form-control ui-autocomplete-input @error('name') is-invalid @enderror" id="exampleInputUsername1" value="{{$edata['name']}}" name="name" autocomplete="off" placeholder="Plz Enter Name">
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
                <input type="text" class="form-control ui-autocomplete-input @error('firmName') is-invalid @enderror" id="exampleInputUsername1" value="{{$edata['firmName']}}" name="firmName" autocomplete="off" placeholder="Plz Enter firmName">
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
                        <option value="1" {{($edata['role'] == "Admin") ? 'selected' : ''}}>Admin</option>
                        <option value="3" {{($edata['role'] == "superDistributer") ? 'selected' : ''}}>Super Distributer</option>
                        <option value="5" {{($edata['role'] == "distributer") ? 'selected' : ''}}>Distributer</option>
                        <option value="7" {{($edata['role'] == "retailer") ? 'selected' : ''}}>Retailer</option>
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
                        @foreach($udata as $value)
                          @if($edata['referralId'] == $value['_id'])
                            <option value="{{$edata['referralId']}}" {{($edata['referralId'] == $value['_id']) ? 'selected' : ''}}>{{$value['userName'] ." ".$value['name']}}</option>
                          @endif
                        @endforeach
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
                <input type="number" class="form-control ui-autocomplete-input @error('password') is-invalid @enderror" id="exampleInputUsername1" maxlength="5" minlength="5" value="{{$edata['password']}}" name="password" autocomplete="off" placeholder="Plz Enter Password">
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
                <input type="number" class="form-control ui-autocomplete-input @error('transactionPin') is-invalid @enderror" id="exampleInputUsername1" value="{{$edata['transactionPin']}}" name="transactionPin" autocomplete="off" placeholder="Plz Enter Transaction Pin">
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
                <input type="text" class="form-control ui-autocomplete-input @error('commissionPercentage') is-invalid @enderror" id="exampleInputUsername1" value="{{$edata['commissionPercentage']}}" name="commissionPercentage" autocomplete="off" placeholder="Plz Enter CommissionPercentage">
                @error('commissionPercentage')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
          </div>
        <div class="form-group d-flex" id="perissions">
          <label class="col-sm-2 offset-lg-1 text-right control-label mt-2">Sharing Permission</label>
          <div class="col-sm-3">
            <div class="form-check form-check-flat form-check-primary">
              <label class="form-check-label" id="full_permission">
                <input type="checkbox" class="form-check-input" name="permission[]" value="full_permission" {{ (isset($edata['permissions']['full_permission'])==true) ? 'checked' : ''}}>
                Full_Permission
              </label>
            </div>
            <div class="form-check form-check-flat form-check-primary">
              <label class="form-check-label" id="add_user">
                <input type="checkbox" class="form-check-input" name="permission[]" value="add_user" {{ (isset($edata['permissions']['add_user'])==true) ? 'checked' : ''}}>
                Add User
              </label>
            </div>
            <div class="form-check form-check-flat form-check-primary">
              <label class="form-check-label" id="view_user">
                <input type="checkbox" class="form-check-input" name="permission[]" value="view_user" {{ (isset($edata['permissions']['view_user'])==true) ? 'checked' : ''}}>
                View User
              </label>
            </div>
            <div class="form-check form-check-flat form-check-primary">
              <label class="form-check-label" id="superdistributer">
                <input type="checkbox" class="form-check-input" name="permission[]"  value="superdistributer" {{ (isset($edata['permissions']['superdistributer'])==true) ? 'checked' : ''}}>
                Superdistributer
              </label>
            </div>
            <div class="form-check form-check-flat form-check-primary">
              <label class="form-check-label" id="distributer">
                <input type="checkbox" class="form-check-input" name="permission[]"  value="distributer" {{ (isset($edata['permissions']['distributer'])==true) ? 'checked' : ''}}>
                Distributer
              </label>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-check form-check-flat form-check-primary">
              <label class="form-check-label" id="retailer">
                <input type="checkbox" class="form-check-input" name="permission[]"  value="retailer" {{ (isset($edata['permissions']['retailer'])==true) ? 'checked' : ''}}>
                Retailer
              </label>
            </div>
            <div class="form-check form-check-flat form-check-primary">
              <label class="form-check-label" id="winningPercent">
                <input type="checkbox" class="form-check-input" name="permission[]"  value="winningPercent" {{ (isset($edata['permissions']['winningPercent'])==true) ? 'checked' : ''}}>
                WinningPercent
              </label>
            </div>
            <div class="form-check form-check-flat form-check-primary">
              <label class="form-check-label" id="winbyadmin">
                <input type="checkbox" class="form-check-input" name="permission[]"  value="winbyadmin" {{ (isset($edata['permissions']['winbyadmin'])==true) ? 'checked' : ''}}>
                Winbyadmin
              </label>
            </div>
            <div class="form-check form-check-flat form-check-primary">
              <label class="form-check-label" id="announcement">
                <input type="checkbox" class="form-check-input" name="permission[]"  value="announcement" {{ (isset($edata['permissions']['announcement'])==true) ? 'checked' : ''}}>
                Announcement
              </label>
            </div>
            <div class="form-check form-check-flat form-check-primary">
              <label class="form-check-label" id="complaint">
                <input type="checkbox" class="form-check-input" name="permission[]"  value="complaint" {{ (isset($edata['permissions']['complaint'])==true) ? 'checked' : ''}}>
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