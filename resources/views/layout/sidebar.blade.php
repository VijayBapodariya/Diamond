<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand" style="font-size:20px">
      Diamond<span> Coupon</span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <div class="media">
        <img class="d-flex align-self-start mr-3" src="{{ url('http://www.slcoupon.com/assets/img/user.png') }}" style="max-width:60px" alt="Generic placeholder image">
        <div class="media-body">
          <p class="name text-success font-weight-bold mb-0" style="font-size:15px">{{Session::get('username')}}</p>
          <p class="email text-primary mb-0">{{Session::get('name')}}</p>
          @if(Session::get('role')!='Admin')
            <p class="email text-primary mb-0">{{number_format(Session::get('creditPoint'),2)}}</p>
          @endif
        </div>
      </div>
      {{-- <div class="nav-item media d-flex flex-column align-items-start">
        <div class="figure mb-2">
          <img src="{{ url('http://www.slcoupon.com/assets/img/user.png') }}" style="width:75px" class="img-responsive d-flex align-self-start mb-1" alt="">
          <div class="media-body">
            
          </div>
        </div>
      </div> --}}
      {{-- <li class="nav-item nav-category">Main</li>
      <li class="nav-item {{ active_class(['/']) }}">
        <a href="{{ url('/dashboard') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li> --}}
  {{-- @php  
    if(array_key_exists("add_user",Session::get('permissions'))){
        echo "vijay";
    }else{
        echo "v";
    }
    die;
  @endphp --}}
      <li class="nav-item nav-category">Palyers</li>
      @if(Session::get('role')=="Admin")
        @if(array_key_exists("add_user",Session::get('permissions')))
          <li class="nav-item {{ active_class(['admin/create']) }}">
            <a href="{{ url('/admin/create') }}" class="nav-link">
              <i class="link-icon" data-feather="user-plus"></i>
              <span class="link-title">Add User</span>
            </a>
          </li>
        @endif
        @if(array_key_exists("view_user",Session::get('permissions')))
        <li class="nav-item {{ active_class(['admin/']) }}">
          <a href="{{ url('/admin') }}" class="nav-link">
            <i class="link-icon" data-feather="user"></i>
            <span class="link-title">View User</span> 
          </a>
        </li>
        @endif
        @if(array_key_exists("superdistributer",Session::get('permissions')))
        <li class="nav-item {{ active_class(['superdistributer/']) }}">
          <a href="{{ url('/superdistributer') }}" class="nav-link">
            <i class="link-icon" data-feather="user"></i>
            <span class="link-title">SuperDistributer</span>
          </a>
        </li>
        @endif
      @endif
      @if(array_key_exists("distributer",Session::get('permissions')))
      <li class="nav-item {{ active_class(['distributer/']) }}">
        <a href="{{ url('/distributer') }}" class="nav-link">
          <i class="link-icon" data-feather="user"></i>
          <span class="link-title">Distributer</span>
        </a>
      </li>
      @endif
      @if(array_key_exists("retailer",Session::get('permissions')))
        <li class="nav-item {{ active_class(['retailer/']) }}">
          <a href="{{ url('/retailer') }}" class="nav-link">
            <i class="link-icon" data-feather="user"></i>
            <span class="link-title">Retailer</span>
          </a>
        </li>
      @endif
        {{-- <li class="nav-item {{ active_class(['players/']) }}">
          <a href="{{ url('/players') }}" class="nav-link">
            <i class="link-icon" data-feather="users"></i>
            <span class="link-title">Players</span>
          </a>
        </li> --}}
      <li class="nav-item {{ active_class(['transfer/']) }}">
        <a href="{{ url('/transfer') }}" class="nav-link">
          <i class="link-icon fa fa-exchange"></i>
          <span class="link-title">Transfer Point</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['OnPlayers/']) }}">
        <a href="{{ url('/OnPlayers') }}" class="nav-link">
          <i class="link-icon fa fa-dashboard"></i>
          <span class="link-title">Show Online Players</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['history/']) }}">
        <a href="{{ url('/history') }}" class="nav-link">
          <i class="link-icon fa fa-history"></i>
          <span class="link-title">Players History</span>
        </a>
      </li>
      @if(array_key_exists("winhistory",Session::get('permissions')))
      <li class="nav-item {{ active_class(['winhistory/']) }}">
        <a href="{{ url('/winhistory') }}" class="nav-link">
          <i class="link-icon fa fa-history"></i>
          <span class="link-title">Win History</span>
        </a>
      </li>
      @endif
      <li class="nav-item {{ active_class(['Tnover/']) }}">
        <a href="{{ url('/Tnover/7/'.date('Y-m-d').'/'.date('Y-m-d')) }}" class="nav-link">
          <i class="link-icon fa fa-pie-chart"></i>
          <span class="link-title">Turnover Report</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['transactions/']) }}">
        <a href="{{ url('/transactions') }}" class="nav-link">
          <i class="link-icon fa fa-money"></i>
          <span class="link-title">Transaction Report</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['cmbreport/']) }}">
        <a href="{{ url('/cmbreport') }}" class="nav-link">
          <i class="link-icon fa fa-money"></i>
          <span class="link-title">Commission Payout Report</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['changepin/']) }}">
        <a href="{{ url('/changepin') }}" class="nav-link">
          <i class="link-icon fa fa-key"></i>
          <span class="link-title">Change Transaction Pin</span>
        </a>
      </li>
      @if(array_key_exists("winningPercent",Session::get('permissions')))
      <li class="nav-item {{ active_class(['winningPercent/']) }}">
        <a href="{{ url('/winningPercent') }}" class="nav-link">
          <i class="link-icon fa fa-trophy"></i>
          <span class="link-title">Winning Percent</span>
        </a>
      </li>
      @endif
      @if(array_key_exists("winbyadmin",Session::get('permissions')))
      <li class="nav-item {{ active_class(['Winbyadmin/']) }}">
        <a href="{{ url('/Winbyadmin') }}" class="nav-link">
          <i class="link-icon fa fa-trophy"></i>
          <span class="link-title">RetailerWin By Admin</span>
        </a>
      </li>
      @endif
      @if(array_key_exists("winbyadmin",Session::get('permissions')))
      <li class="nav-item {{ active_class(['announcement/']) }}">
        <a href="{{ url('/announcement') }}" class="nav-link">
          <i class="link-icon fa fa-stop"></i>
          <span class="link-title">Announcement</span>
        </a>
      </li>
      @endif
      @if(array_key_exists("winbyadmin",Session::get('permissions')))
      <li class="nav-item {{ active_class(['complaint/']) }}">
        <a href="{{ url('/complaint') }}" class="nav-link">
          <i class="link-icon" data-feather="cloud-off"></i>
          <span class="link-title">Complaint</span>
        </a>
      </li>
      @endif
    </ul>
  </div>
</nav>