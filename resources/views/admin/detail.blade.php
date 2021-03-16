@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow">
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body bg-primary text-white">
            <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title text-white mb-2">{{$data['role']}} Details</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <div class="align-items-baseline">
                    <table class="table table-borderless">
                        <tbody class="text-white">
                          <tr>
                            <td style="padding:0;"><p>Username:</p></td>
                            <td style="padding:0 0 0 10px;"><p>&nbsp;{{$data['userName']}}</p></td> 
                          </tr>
                          <tr>
                            <td style="padding:0;"><p>Name:</p></td>
                            <td style="padding:0 0 0 10px;"><p>&nbsp;{{$data['name']}}</p></td> 
                          </tr>
                          <tr>
                            <td style="padding:0"><p>Revenue:</p></td>
                            <td style="padding:0 0 0 10px;"><p>&nbsp;0.00</p></td> 
                          </tr>
                          <tr>
                            <td style="padding:0"><p>Type:</p></td>
                            <td style="padding:0 0 0 10px;"><p>&nbsp;TN</p></td> 
                          </tr>
                        </tbody>
                    </table>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                <div id="apexChart1" class="mt-md-3 mt-xl-0"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body bg-success text-white">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-2 text-white">Credit</h6>
            </div>
            <div class="row">
              <div class="col-12 col-md-12 col-xl-12">
                <h2 class="mb-2">{{number_format($data['creditPoint'],2)}}</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body bg-danger">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title text-white mb-2">Last Week</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <div class="d-flex align-items-baseline">
                    <table class="table table-borderless">

                        <tbody class="text-white">
                          <tr>
                            <td style="padding:0;"><p>Total Played:</p></td>
                            <td style="padding:0 0 0 10px;"><p>{{number_format($total['LastTotalPlayPoint'],2)}}</p></td> 
                          </tr>
                          <tr>
                            <td style="padding:0;"><p>Total Won:</p></td>
                            <td style="padding:0 0 0 10px;"><p>{{number_format($total['LastTotalWinPoint'],2)}}</p></td> 
                          </tr>
                          <tr>
                            <td style="padding:0"><p>End Point:</p></td>
                            <td style="padding:0 0 0 10px;"><p>{{number_format($total['LastTotalEndPoint'],2)}}</p></td> 
                          </tr>
                          <tr>
                            <td style="padding:0"><p>Retailer Commisssion:</p></td>
                            <td style="padding:0 0 0 10px;"><p>{{number_format($total['LastTotalRetailerCommission'],2)}}</p></td> 
                          </tr>
                        </tbody>
                    </table>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                <div id="apexChart3" class="mt-md-3 mt-xl-0"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body bg-info">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title text-white mb-2">This Week</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <div class="d-flex align-items-baseline">
                    <table class="table table-borderless">
                        <tbody class="text-white">
                          <tr>
                            <td style="padding:0;"><p>Total Played:</p></td>
                            <td style="padding:0 0 0 10px;"><p>{{number_format($total['TotalPlayPoint'],2)}}</p></td> 
                          </tr>
                          <tr>
                            <td style="padding:0;"><p>Total Won:</p></td>
                            <td style="padding:0 0 0 10px;"><p>{{number_format($total['TotalWinPoint'],2)}}</p></td> 
                          </tr>
                          <tr>
                            <td style="padding:0"><p>End Point:</p></td>
                            <td style="padding:0 0 0 10px;"><p>{{number_format($total['TotalEndPoint'],2)}}</p></td> 
                          </tr>
                          <tr>
                            <td style="padding:0"><p>Retailer Commisssion:</p></td>
                            <td style="padding:0 0 0 10px;"><p>{{number_format($total['TotalRetailerCommission'],2)}}</p></td> 
                          </tr>
                        </tbody>
                    </table>
                </div>
              </div>
              <div class="col-6 col-md-12 col-xl-7">
                <div id="apexChart3" class="mt-md-3 mt-xl-0"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">
            @if($data['role'] == "Admin")
              SuperDistributers
            @elseif($data['role'] == "superDistributer")
              Distributers
            @elseif($data['role'] == "distributer")
              Retailer
            @endif
          </h6>
          <div class="table-responsive">
            <table id="dataTableExample" class="table table-bordered">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Username</th>
                  <th>Name</th>
                  <th>Reffer</th>
                  <th>Revenue</th>
                  <th>Type</th>
                  <th>Credit</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php $no = 1 @endphp
                @foreach($user as $value)
                  <tr role="row" class="odd">
                      <td class="">{{$no++}}</td>
                      <td><a href="{{ url('player/detail/'.$value['_id'])}}">{{$value['userName']}} <i class="mdi mdi-eye"></i></a></td>
                      <td>{{$value['name']}}</td>
                      <td class="sorting_1">
                          @if($value['referralId'] == $data['_id'])
                            {{$data['userName']}}
                          @endif
                      </td>
                      <td>0.00</td>
                      <td>TN</td>
                      <td>{{number_format($value['creditPoint'],2)}}</td>
                      <td>
                          <div class="btn-group">
                            <div class="btn-group">
                              <a href="{{ url('users/edit/'.$value['_id'])}}" type="button" class="btn btn-outline-info" title="Edit user"><i class="mdi mdi-pencil-box" style="font-size:20px;"></i></a>
                              @if(Session::get('role')=="superDistributer")
                                <a href="{{ url('users/transfercredit/'.$value['_id']) }}" class="btn btn-outline-success" title="Transfer Credit"><i class="mdi mdi-package-up" style="font-size:20px;"></i></a>
                                <a href="{{ url('users/adjustcredit/'.$value['_id'])}}" class="btn btn-outline-warning" title="Adjust Credit"><i class="mdi mdi-package-down" style="font-size:20px;"></i></a>
                              @endif
                              @if($value['isActive']==1)
                                <a href="{{ url('users/banuser/'.$value['_id'].'/'.$value['isActive'])}}" class="btn btn-outline-success" title="Ban User"><i class="mdi mdi-close-box" style="font-size:20px;"></i></a>
                              @elseif($value['isActive']==0)
                                <a href="{{ url('users/banuser/'.$value['_id'].'/0')}}" class="btn btn-outline-danger" title="UnBan User"><i class="mdi mdi-checkbox-marked" style="font-size:20px;"></i></a>
                              @endif
                              @if(Session::get('role') == 'Admin')
                                <a href="{{ url('users/delete/'.$value['_id'])}}" class="btn btn-outline-danger delete-confirm" title="delete"><i class="mdi mdi-delete" style="font-size:20px;"></i></a>
                              @endif
                          </div>
                          </div>
                      </td>
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
  <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  {{-- <script src="{{ asset('assets/js/sweet-alert.js') }}"></script> --}}
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript">
    $('.delete-confirm').on('click', function (event) {
      event.preventDefault();
      const url = $(this).attr('href');
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false,
      })
      swalWithBootstrapButtons.fire({ 
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonClass: 'ml-2',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
          window.location.href = url;
          swalWithBootstrapButtons.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        } else if (
          // Read more about handling dismissals
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your imaginary file is safe :)',
            'error'
          )
        }
      })
    });
  </script>
@endpush