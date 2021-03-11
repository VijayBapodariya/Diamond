@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush


@push('custom-styles')
  <style type="text/css" rel="stylesheet">
    
  </style>
@endpush

@section('content')

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Player History</h6>
        {{-- <p class="card-description">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p> --}}
        <div class="table-responsive">
          <table id="dataTableExample" class="table table-bordered">
            <thead>
              <tr>
                <th>Sl_no</th>
                <th>Date</th>
                <th>Username</th>
                <th>Name</th>
                <th>Start Point</th>
                <th>Bet</th>
                <th>Won</th>
                <th>End Point</th>
                <th>Agent Commission</th>
                <th>Claim Status</th>
                <th>View</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $sl_no = 1;
                @endphp
                @foreach ($data as $value)
                    @if(!empty($value['winPositions']))
                        <tr role="row">
                            <td class="">{{$sl_no++}}</td>
                            <td><?php echo date("d/m/Y h:i A",strtotime($value['createdAt']));?></td>
                            <td>{{$value['userName']}}<br>{{$value['ticketId']}}</td>
                            <td>{{$value['name']}}</td>
                            <td>{{number_format($value['startPoint'],2)}}</td>
                            <td>{{number_format($value['betPoint'],2)}}</td>
                            <td>{{number_format($value['won'],2)}}</td>
                            <td>{{number_format($value['startPoint']-$value['betPoint']+$value['won'],2)}}</td>
                            <td>0.00</td>
                            <td>{{ ($value['claim']) ? 'Yes' : 'No' }}</td>
                            <td>
                                <button type="button" class="btn btn-primary mx-1" data-toggle="modal" data-target="#message{{$value['_id']}}">view</button>

                                <div id="message{{$value['_id']}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-xl">
        
                                    <!-- Modal content-->
                                    <div class="modal-content modal-xl">
                                        <div class="modal-header">
                                        
                                        <h4 class="modal-title" id="myModalLabel">Play History</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <div class="modal-body" id="contain"><div class="">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                        <td><strong>Id</strong></td><td>{{$value['_id']}}</td>
                                        <td><strong>Player</strong></td><td>{{$value['userName']}}</td>
                                        </tr>
                                        <tr>
                                        <td><strong>Game</strong></td><td>Coupon</td>
                                        <td><strong>Date</strong></td><td><?php echo date("d/m/Y h:i A",strtotime($value['createdAt']));?></td>
                                        </tr>
                                        <tr>
                                        <td><strong>Bet</strong></td><td>{{number_format($value['betPoint'],2)}}</td>
                                        <td><strong>Won</strong></td><td>{{number_format($value['won'],2)}}</td>
                                        </tr>
                                        @php 
                                            $winpos = "";
                                            foreach($value['winPositions'] as $v){
                                                $length = 2;
                                                $winpos .= str_pad($v,$length,"0", STR_PAD_LEFT).",";
                                            }
                                            $winpos = trim($winpos,',');
                                        @endphp
                                        <tr><td><strong>Win Position</strong></td><td>{{"[".$winpos."]"}}</td>
                                            <td><strong>Series No</strong></td><td>{{$value['seriesNo']}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <div style="width: 100%; float: left;">
                                
                                    <table class="table table-bordered" style="width: 300px;">
                                    <tbody>
                                        <tr>
                                            <td>#</td>
                                            <td>Bet</td>
                                            <td>Won</td>
                                            <td>Result</td>
                                        </tr>
                                        <tr>
                                            <td>Lottery</td>
                                            <td>{{number_format($value['betPoint'],2)}}</td>
                                            <td>{{number_format($value['won'],2)}}</td>
                                            <td>{{"[".$winpos."]"}}</td>
                                        </tr>
                                    </tbody>
                                    </table>
                                
                                </div>
                                
                                <div style="clear: both; height: 10px;"></div>
                                <div style="clear: both; height: 10px;"></div>
                                        @php
                                            $ser = $value['seriesNo'];
                                            $po=$ser*1000;
                                            $no=$po;
                                            $win = $value['winPositions']; 
                                            $bets = $value['ticketBets'];
                                            // $k = 1;
                                            // foreach($bets as $key => $v){
                                            //   echo $key;
                                            //   if($key==chr(64+$k)){
                                            //     foreach ($v as $ke => $p){
                                            //       echo $ke."_".$p.","."<br>";
                                            //     }
                                            //   }
                                            //   $k++;
                                            // }
                                            // die;
                                            // echo "<pre>".'fvhfbvfhvbfhvbfh';
                                            //   $app = array("bana"=>array("1"=>2),"app","gerp");
                                            // echo in_array("bana",$app);
                                            
                                            // die;
                                        @endphp
                                        <h2>Bet Details</h2>
                                        <table class="table table-bordered">
                                            <tbody>
                                            <tr>
                                            <th>Bet Position</th>
                                            <th>Amount</th>
                                            </tr>
                                            @for($k=1;$k<=10;$k++)     
                                            <tr>
                                                <td>{{chr(64+$k)}} {{$no}}-{{$no+99}}</td>
                                                <td>
                                                <table style="border:2px solid #4f7dda;width:250px;">
                                                    <tbody>
                                                    @for($i=1;$i<=5;$i++)
                                                        <tr class="text-center">
                                                        @for($j=1000;$j<=1019;$j++)
                                                            @php 
                                                                // echo $no;
                                                                $check = substr($no,-2);
                                                                $win[$k-1];
                                                                // die;
                                                                $bull = false;
                                                            @endphp
                                                            @if(isset($bets[chr(64+$k)]))
                                                                @if(isset($bets[chr(64+$k)][$check]))
                                                                @php $length = 2; $bull = true; @endphp
                                                                @if($check==$win[$k-1] && $win[$k-1]!="")
                                                                    <td style="padding:0.2rem 0.2rem;line-height: 1rem;vertical-align: unset;"><span style="font-size:14px;">{{$no++}}</span><br>
                                                                    <span style="border:2px solid #fff;padding:2px 9px;color:#000;background:#37c22b;">{{str_pad($bets[chr(64+$k)][$check],$length,"0", STR_PAD_LEFT)}}</span></td><!--46A4FF-->
                                                                @else
                                                                    <td style="padding:0.2rem 0.2rem;line-height: 1rem;vertical-align: unset;"><span style="font-size:14px;">{{$no++}}</span><br>
                                                                    <span style="border:2px solid #fff;padding:2px 9px;color:#000;background:#46A4FF;">{{str_pad($bets[chr(64+$k)][$check],$length,"0", STR_PAD_LEFT)}}</span></td><!--46A4FF-->
                                                                @endif
                                                                @endif
                                                            @endif
                                                            @if($bull==false)
                                                                @if($check==$win[$k-1] && $win[$k-1]!="")
                                                                <td style="padding:0.2rem 0.2rem;line-height: 1rem;vertical-align: unset;"><span style="font-size:14px;">{{$no++}}</span><br>
                                                                <span style="border:2px solid #fff;padding:2px 9px;color:#000;background:#ff3366;">00</span></td><!--46A4FF-->
                                                                @else
                                                                <td style="padding:0.2rem 0.2rem;line-height: 1rem;vertical-align: unset;"><span style="font-size:14px;">{{$no++}}</span><br>
                                                                <span style="border:2px solid #fff;padding:2px 9px;color:#000;background:#D9DDFF;">00</span></td><!--46A4FF-->
                                                                @endif
                                                            @endif
                                                        @endfor
                                                        </tr>
                                                    @endfor
                                                    </tbody>
                                                </table>
                                                </td>
                                            </tr>
                                            @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </td>
                        </tr>
                    @endif
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
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush