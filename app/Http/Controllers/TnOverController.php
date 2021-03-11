<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bets;
use Session;
use App\User;
use Carbon\Carbon;

class TnOverController extends Controller
{
    public function index($type,$from,$to)
    {
        // return view('turnOver');
        $resArray=array();
        $totalPlayPoints=0;
        $TotalWinPoints=0;
        $EndPoint=0;
        $TotalRetailerCommission = 0;
        $TotalCommission = 0;
        $today=date_create(date("Y-m-d"));

        $fm = date('m',strtotime($from));
        $fd = date('d',strtotime($from));
        $fY = date('Y',strtotime($from));

        $tm = date('m',strtotime($to));
        
        $tY = date('Y',strtotime($to));

        if(Session::get('role')=="Admin"){
            $superdistributer = User::where('role','superDistributer')->where('referralId',new \MongoDB\BSON\ObjectID(Session::get('id')))->get();
            $admin = User::where('_id',new \MongoDB\BSON\ObjectID(Session::get('id')))->get();
            foreach($superdistributer as $super){
                $distributer = User::where('referralId',new \MongoDB\BSON\ObjectID($super['_id']))->get();
                foreach($distributer as $dis_user){
                    $retailer = User::where('referralId',new \MongoDB\BSON\ObjectID($dis_user['_id']))->get();
                    $retailers = [];
                    foreach($retailer as $re_user){
                        $retailers[] = new \MongoDB\BSON\ObjectID($re_user['_id']); 
                    }  
                    if($type==1 || $type==2 || $type==3 || $type==4 || $type==5){
                        $td = date('d',strtotime($to));
                        $playPoints = Bets::whereIn('retailerId',$retailers)
                                        ->whereBetween(
                                            'createdAt', array(
                                                Carbon::createFromDate($fY, $fm, $fd),
                                                Carbon::createFromDate($tY, $tm, $td)
                                            )
                                        )->orderBy('createdAt','DESC')->get();
                    }elseif($type==7 || $type==6){
                        $to = date('Y-n-d',strtotime($to));
                        $playPoints = Bets::whereIn('retailerId',$retailers)
                                        ->where('DrDate',$to)->orderBy('createdAt','DESC')->get();
                    }
                    // echo "<pre>";print_r($playPoints->toArray());die(); 
                    foreach($playPoints as $play){
                        $totalPlayPoints += $play['betPoint'];
                        $TotalWinPoints += $play['won'];
                        $EndPoint += $totalPlayPoints - $TotalWinPoints;
                        $TotalRetailerCommission = 0;
                        $TotalCommission = 0;
                    }
                    $total = [];
                    $total['totalPlayPoints'] = $totalPlayPoints;
                    $total['TotalWinPoints'] = $TotalWinPoints;
                    $total['EndPoint'] = $EndPoint;
                    $total['TotalRetailerCommission'] = $TotalRetailerCommission;
                    $total['TotalCommission'] = $TotalCommission;
                    return view('turnOver', ['data' => $admin,'total'=>$total]);
                }
            }
            echo "<pre>";print_r($playPoints->toArray());die();
            // echo "<pre>";print_r($superdistributer->toArray());die();
            $playPoints = Bets::orderBy('createdAt','DESC')->get();
            // return view('history', ['data' => $playPoints]);
        }elseif(Session::get('role')=="superDistributer"){
            $superDistributer = User::where('_id',new \MongoDB\BSON\ObjectID(Session::get('id')))->get();
            $distributer = User::where('referralId',new \MongoDB\BSON\ObjectID(Session::get('id')))->get();
            foreach($distributer as $dis_user){
                $retailer = User::where('referralId',new \MongoDB\BSON\ObjectID($dis_user['_id']))->get();
                $retailers = [];
                foreach($retailer as $re_user){
                    $retailers[] = new \MongoDB\BSON\ObjectID($re_user['_id']); 
                }   
                if($type==1 || $type==2 || $type==3 || $type==4 || $type==5){
                    $td = date('d',strtotime($to));
                    $playPoints = Bets::whereIn('retailerId',$retailers)
                                    ->whereBetween(
                                        'createdAt', array(
                                            Carbon::createFromDate($fY, $fm, $fd),
                                            Carbon::createFromDate($tY, $tm, $td)
                                        )
                                    )->orderBy('createdAt','DESC')->get();
                }elseif($type==7 || $type==6){
                    $to = date('Y-n-d',strtotime($to));
                    $playPoints = Bets::whereIn('retailerId',$retailers)
                                    ->where('DrDate',$to)->orderBy('createdAt','DESC')->get();
                }
                // echo "<pre>";print_r($playPoints->toArray());die(); 
                foreach($playPoints as $play){
                    $totalPlayPoints += $play['betPoint'];
                    $TotalWinPoints += $play['won'];
                    $EndPoint += $totalPlayPoints - $TotalWinPoints;
                    $TotalRetailerCommission = 0;
                    $TotalCommission = 0;
                }
                $total = [];
                $total['totalPlayPoints'] = $totalPlayPoints;
                $total['TotalWinPoints'] = $TotalWinPoints;
                $total['EndPoint'] = $EndPoint;
                $total['TotalRetailerCommission'] = $TotalRetailerCommission;
                $total['TotalCommission'] = $TotalCommission;
                return view('turnOver', ['data' => $superDistributer,'total'=>$total]);
                // return view('history', ['data' => $playPoints]);
            }
        }elseif(Session::get('role')=="distributer"){
            $distributer = User::where('_id',new \MongoDB\BSON\ObjectID(Session::get('id')))->get();
            $retailer = User::where('referralId',new \MongoDB\BSON\ObjectID(Session::get('id')))->get();
            $retailers = [];
            foreach($retailer as $re_user){
                $retailers[] = new \MongoDB\BSON\ObjectID($re_user['_id']); 
            }   
            if($type==1 || $type==2 || $type==3 || $type==4 || $type==5){
                $td = date('d',strtotime($to));
                $playPoints = Bets::whereIn('retailerId',$retailers)
                                ->whereBetween(
                                    'createdAt', array(
                                        Carbon::createFromDate($fY, $fm, $fd),
                                        Carbon::createFromDate($tY, $tm, $td)
                                    )
                                )->orderBy('createdAt','DESC')->get();
            }elseif($type==7 || $type==6){
                $to = date('Y-n-d',strtotime($to));
                $playPoints = Bets::whereIn('retailerId',$retailers)
                                ->where('DrDate',$to)->orderBy('createdAt','DESC')->get();
            }
            // echo "<pre>";print_r($playPoints->toArray());die(); 
            foreach($playPoints as $play){
                $totalPlayPoints += $play['betPoint'];
                $TotalWinPoints += $play['won'];
                $EndPoint += $totalPlayPoints - $TotalWinPoints;
                $TotalRetailerCommission = 0;
                $TotalCommission = 0;
            }
            $total = [];
            $total['totalPlayPoints'] = $totalPlayPoints;
            $total['TotalWinPoints'] = $TotalWinPoints;
            $total['EndPoint'] = $EndPoint;
            $total['TotalRetailerCommission'] = $TotalRetailerCommission;
            $total['TotalCommission'] = $TotalCommission;
            return view('turnOver', ['data' => $distributer,'total'=>$total]);
        }elseif(Session::get('role')=="retailer"){
            $retailerd = User::where('_id',new \MongoDB\BSON\ObjectID(Session::get('id')))->get();
            $retailer = User::where('referralId',new \MongoDB\BSON\ObjectID(Session::get('id')))->get();
            $retailers = [];
            foreach($retailer as $re_user){
                $retailers[] = new \MongoDB\BSON\ObjectID($re_user['_id']); 
            }   
            if($type==1 || $type==2 || $type==3 || $type==4 || $type==5){
                $td = date('d',strtotime($to));
                $playPoints = Bets::whereIn('retailerId',$retailers)
                                ->whereBetween(
                                    'createdAt', array(
                                        Carbon::createFromDate($fY, $fm, $fd),
                                        Carbon::createFromDate($tY, $tm, $td)
                                    )
                                )->orderBy('createdAt','DESC')->get();
            }elseif($type==7 || $type==6){
                $to = date('Y-n-d',strtotime($to));
                $playPoints = Bets::whereIn('retailerId',$retailers)
                                ->where('DrDate',$to)->orderBy('createdAt','DESC')->get();
            }
            // echo "<pre>";print_r($playPoints->toArray());die(); 
            foreach($playPoints as $play){
                $totalPlayPoints += $play['betPoint'];
                $TotalWinPoints += $play['won'];
                $EndPoint += $totalPlayPoints - $TotalWinPoints;
                $TotalRetailerCommission = 0;
                $TotalCommission = 0;
            }
            $total = [];
            $total['totalPlayPoints'] = $totalPlayPoints;
            $total['TotalWinPoints'] = $TotalWinPoints;
            $total['EndPoint'] = $EndPoint;
            $total['TotalRetailerCommission'] = $TotalRetailerCommission;
            $total['TotalCommission'] = $TotalCommission;
            return view('turnOver', ['data' => $retailerd,'total'=>$total]);
        }
        // return view('turnOver');
    }
}
