<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Bets;
use App\Payments;
use App\Announcements;
use App\Winresults;
use Session;
use Carbon\Carbon;


class CommanController extends Controller
{
    public function OnPlayers()
    {
        $user = User::where('role','retailer')->where('isLogin',true)->get();
        $users = User::all();
        foreach($users as $value){
            $playPoint = Bets::all();
            foreach($playPoint as $play){
                if($value['_id']==$play['retailerId']){
                    $betPoint = 0;
                    $wonPoint = 0;
                    $endPoint = 0;
                    foreach ($playPoint as $pl) {
                        if ($pl['retailerId'] == $value['_id']) {
                            $betPoint += $pl['betPoint'];
                            $wonPoint += $pl['won'];
                            $endPoint = $value['creditPoint'] - $betPoint + $wonPoint;
                        }
                    }
                    $Point = array();
                    $Point['betPoint'] = $betPoint;
                    $Point['wonPoint'] = $wonPoint;
                    $Point['endPoint'] = $endPoint;
                    // echo "<pre>";
                    // print_r($Point);
                    // die();
                    return view('showOnPlayer', ['data' => $user, 'users' => $users, 'point' => $Point]);
                }
            }
        }
        return redirect()->back();
    }

    public function history()
    {   
        $playPoint = Bets::orderBy('createdAt','DESC')->get();
        foreach ($playPoint as $play){
            if(Session::get('role')=="Admin"){
                    $playPoints = Bets::orderBy('createdAt','DESC')->get();
                    return view('history', ['data' => $playPoints]);
            }elseif(Session::get('role')=="superDistributer"){
                $distributer = User::where('referralId',new \MongoDB\BSON\ObjectID(Session::get('id')))->get();
                foreach($distributer as $dis_user){
                    $retailer = User::where('referralId',new \MongoDB\BSON\ObjectID($dis_user['_id']))->get();
                    $retailers = [];
                    foreach($retailer as $re_user){
                        $retailers[] = new \MongoDB\BSON\ObjectID($re_user['_id']); 
                    }   
                    $playPoints = Bets::whereIn('retailerId',$retailers)->orderBy('createdAt','DESC')->get();
                    return view('history', ['data' => $playPoints]);
                }
            }elseif(Session::get('role')=="distributer"){
                $retailer = User::where('referralId',new \MongoDB\BSON\ObjectID(Session::get('id')))->get();
                $retailers = [];
                foreach($retailer as $re_user){
                    $retailers[] = new \MongoDB\BSON\ObjectID($re_user['_id']); 
                }   
                $playPoints = Bets::whereIn('retailerId',$retailers)->orderBy('createdAt','DESC')->get();
                return view('history', ['data' => $playPoints]);
            }elseif(Session::get('role')=="retailer"){
                if($play['retailerId']==Session::get('id')){
                    $playPoints = Bets::where('retailerId',$play['retailerId'])->orderBy('createdAt','DESC')->get();
                    return view('history', ['data' => $playPoints]);
                }
            }
        }
    }

    public function winhistory()
    {
        $win = Winresults::orderBy('createdAt','DESC')->paginate(10);
        // echo "<pre>";print_r($win->toArray());die;
        return view('winhistory',['win'=>$win]);
    }

    public function winhistorys(Request $request)
    {

        // echo "<pre>";print_r($request->toArray());
        $fm = date('m',strtotime($request->from));
        $fd = date('d',strtotime($request->from));
        $fY = date('Y',strtotime($request->from));

        $tm = date('m',strtotime($request->to));
        $td = date('d',strtotime($request->to));
        $tY = date('Y',strtotime($request->to));

        // echo $from = ;echo "<br>"; //need a space after dates.
        $win = Winresults::whereBetween(
                                    'createdAt', array(
                                        Carbon::createFromDate($fY, $fm, $fd),
                                        Carbon::createFromDate($tY, $tm, $td)
                                    )
                                )->paginate(10);
        // echo "<pre>";print_r($win->toArray());die;
        return view('winhistory',['win'=>$win]);
    }

    public function transactions()
    {
        $users = User::all();
        $user = User::where('_id',Session::get('id'))->get();
        $payment = Payments::where('fromId',Session::get('id'))->orderBy('createdAt','DESC')->get();
        foreach($payment as $key => $pay){
            $users = User::where('_id',new \MongoDB\BSON\ObjectID($pay['toId']))->first();
            // echo "<pre>";print_r($users);die();
            // $payment[$key]['createdAt'] = Carbon::parse( $pay['createdAt'] )->toDayDateTimeString();
            $payment[$key]['userName']=$users['userName'];
        }
        // echo "<pre>";print_r($payment->toArray());die;
        return view('transaction',['data'=>$users,'payment'=>$payment,'user'=>$user]);
    }

    public function cmbreport()
    {
        $resArray=array();
        $totalStartPoint = 0;
        $totalPlayPoints=0;
        $TotalWinPoints=0;
        $EndPoint=0;
        $TotalRetailerCommission = 0;
        $TotalDistributerCommission = 0;
        $TotalSuperDistributerCommission = 0;
        $TotalCommission = 0;

        if(Session::get('role')=="Admin"){
            $superdistributer = User::where('role','superDistributer')->where('referralId',new \MongoDB\BSON\ObjectID(Session::get('id')))->get();
            $admin = User::where('_id',new \MongoDB\BSON\ObjectID(Session::get('id')))->first();
            // echo "<pre>";print_r($admin->toArray());die();
            foreach($superdistributer as $super){
                $distributer = User::where('referralId',new \MongoDB\BSON\ObjectID($super['_id']))->get();
                foreach($distributer as $dis_user){
                    $retailer = User::where('referralId',new \MongoDB\BSON\ObjectID($dis_user['_id']))->get();
                    $retailers = [];
                    foreach($retailer as $re_user){
                        $retailers[] = new \MongoDB\BSON\ObjectID($re_user['_id']);
                    } 
                    $playPoints = Bets::whereIn('retailerId',$retailers)
                                        ->orderBy('DrDate')
                                        ->get()
                                        ->groupBy(function ($val) {
                                            return Carbon::parse($val->DrDate)->format('d-m-Y');
                                        });
                    // echo "<pre>";print_r($playPoints->toArray());die();
                    $commission = [];
                    foreach($playPoints as $day => $players) {
                        foreach($players as $player){
                            $commission[$day]['userName'] = $admin['userName'];
                            $commission[$day]['role'] = $admin['role'];
                            $commission[$day]['name'] = $admin['name'];
                            $commission[$day]['super'] = $super['userName'];
                            $commission[$day]['dis'] = $dis_user['userName'];
                            foreach($retailer as $re_user){
                                if($re_user['_id']==$player['retailerId']){
                                    $commission[$day]['retailer'] = $re_user['userName'];
                                }
                            }
                            $TotalRetailerCommission += $player['retailerCommission'];
                            $TotalDistributerCommission += $player['distributerCommission'];
                            $TotalSuperDistributerCommission += $player['superDistributerCommission'];
                            $commission[$day]['TotalRetailerCommission'] = $TotalRetailerCommission;
                            $commission[$day]['TotalDistributerCommission'] = $TotalDistributerCommission;
                            $commission[$day]['TotalSuperDistributerCommission'] = $TotalSuperDistributerCommission;
                        }
                    }
                    
                    // echo "<pre>";print_r($commission);die();
                    return view('commissionPayout', ['data' => $commission]);
                }
            }
        }elseif(Session::get('role')=="superDistributer"){
            $superDistributer = User::where('_id',new \MongoDB\BSON\ObjectID(Session::get('id')))->first();
            $distributer = User::where('referralId',new \MongoDB\BSON\ObjectID(Session::get('id')))->get();
            foreach($distributer as $dis_user){
                $retailer = User::where('referralId',new \MongoDB\BSON\ObjectID($dis_user['_id']))->get();
                $retailers = [];
                foreach($retailer as $re_user){
                    $retailers[] = new \MongoDB\BSON\ObjectID($re_user['_id']); 
                }   
                $playPoints = Bets::whereIn('retailerId',$retailers)
                                        ->orderBy('DrDate')
                                        ->get()
                                        ->groupBy(function ($val) {
                                            return Carbon::parse($val->DrDate)->format('d-m-Y');
                                        });
                // echo "<pre>";print_r($playPoints->toArray());die();
                $commission = [];
                foreach($playPoints as $day => $players){
                    foreach($players as $player){
                        $commission[$day]['userName'] = $superDistributer['userName'];
                        $commission[$day]['role'] = $superDistributer['role'];
                        $commission[$day]['name'] = $superDistributer['name'];
                        $commission[$day]['dis'] = $dis_user['userName'];
                        foreach($retailer as $re_user){
                            if($re_user['_id']==$player['retailerId']){
                                $commission[$day]['retailer'] = $re_user['userName'];
                            }
                        }
                        $TotalRetailerCommission += $player['retailerCommission'];
                        $TotalDistributerCommission += $player['distributerCommission'];
                        $commission[$day]['TotalRetailerCommission'] = $TotalRetailerCommission;
                        $commission[$day]['TotalDistributerCommission'] = $TotalDistributerCommission;
                    }
                }
                return view('commissionPayout', ['data' => $commission]);
                // return view('history', ['data' => $playPoints]);
            }
        }elseif(Session::get('role')=="distributer"){
            $distributer = User::where('_id',new \MongoDB\BSON\ObjectID(Session::get('id')))->first();
            $retailer = User::where('referralId',new \MongoDB\BSON\ObjectID(Session::get('id')))->get();
            $retailers = [];
            foreach($retailer as $re_user){
                $retailers[] = new \MongoDB\BSON\ObjectID($re_user['_id']); 
            }   
            $playPoints = Bets::whereIn('retailerId',$retailers)
                                        ->orderBy('DrDate')
                                        ->get()
                                        ->groupBy(function ($val) {
                                            return Carbon::parse($val->DrDate)->format('d-m-Y');
                                        });
            // echo "<pre>";print_r($playPoints->toArray());die();
            $commission = [];
            foreach($playPoints as $day => $players){
                foreach($players as $player){
                    $commission[$day]['userName'] = $distributer['userName'];
                    $commission[$day]['role'] = $distributer['role'];
                    $commission[$day]['name'] = $distributer['name'];
                    foreach($retailer as $re_user){
                        if($re_user['_id']==$player['retailerId']){
                            $commission[$day]['retailer'] = $re_user['userName'];
                        }
                    }
                    $TotalRetailerCommission += $player['retailerCommission'];
                    $commission[$day]['TotalRetailerCommission'] = $TotalRetailerCommission;
                }
            }
            // echo "<pre>";print_r($commission);die();
            return view('commissionPayout', ['data' => $commission]);
        }elseif(Session::get('role')=="retailer"){
            $retailerd = User::where('_id',new \MongoDB\BSON\ObjectID(Session::get('id')))->first();
            $retailer = User::where('_id',new \MongoDB\BSON\ObjectID(Session::get('id')))->get();
            // echo "<pre>";print_r($retailer->toArray());die();
            $retailers = [];
            foreach($retailer as $re_user){
                $retailers[] = new \MongoDB\BSON\ObjectID($re_user['_id']); 
            }
            $playPoints = Bets::whereIn('retailerId',$retailers)
                                        ->orderBy('DrDate')
                                        ->get()
                                        ->groupBy(function ($val) {
                                            return Carbon::parse($val->DrDate)->format('d-m-Y');
                                        });
            // echo "<pre>";print_r($playPoints->toArray());die();
            $commission = [];
            foreach($playPoints as $day => $players){
                foreach($players as $player){
                    $commission[$day]['userName'] = $retailerd['userName'];
                    $commission[$day]['role'] = $retailerd['role'];
                    $commission[$day]['name'] = $retailerd['name'];
                    $TotalRetailerCommission += $player['retailerCommission'];
                    $commission[$day]['TotalRetailerCommission'] = $TotalRetailerCommission;
                }
            }
            // echo "<pre>";print_r($commission);die();
            return view('commissionPayout', ['data' => $commission]);
        }
    }

    public function announcement()
    {
        $announcement = Announcements::find(new \MongoDB\BSON\ObjectID('6039ea5b9ee94d505a90dd3e'));
        return view('announcement', ['data' => $announcement]);
    }

    public function announcements(Request $request)
    {
        $announcement = Announcements::find(new \MongoDB\BSON\ObjectID('6039ea5b9ee94d505a90dd3e'));
        $announcement->announcement = $request->amount;
        $announcement->save();
        return redirect('announcement/');
    }

    public function blockedPlayers()
    {
        $users = User::where('isActive',false)->get();
        foreach($users as $key => $user){
            $reffrel = User::where('_id',new \MongoDB\BSON\ObjectID($user['referralId']))->first();
            $users[$key]['referral']=$reffrel['userName'];
        }
        // echo "<pre>";print_r($users->toArray());die();
        return view('/blockedPlayers',['data' => $users]);
    }
}
