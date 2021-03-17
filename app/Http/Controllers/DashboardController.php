<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Bets;
use App\Complaints;
use App\Payments;
use App\Winnings;
use App\Winresults;
use App\WinnerIds;
use Session;

class DashboardController extends Controller
{
    public function index()
    {
        $dash = [];
        $dash['users'] = User::where('role','Admin')->count();
        $dash['superDistributer'] = User::where('role','superDistributer')->count();
        $dash['distributer'] = User::where('role','distributer')->count();
        $dash['retailer'] = User::where('role','retailer')->count();
        $dash['ShowOnplayer'] = User::where('role','retailer')->where('isLogin',true)->count();

        $totalStartPoint = 0;
        $totalPlayPoints=0;
        $TotalWinPoints=0;
        $EndPoint=0;
        $TotalRetailerCommission = 0;
        $TotalAdminCommission = 0;
        $TotalDistributerCommission = 0;
        $TotalSuperDistributerCommission = 0;
        $TotalCommission = 0;

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
                    $playPoints = Bets::whereIn('retailerId',$retailers)->orderBy('createdAt','DESC')->get();
                    foreach($playPoints as $play){
                        $TotalRetailerCommission += $play['retailerCommission'];
                        $TotalDistributerCommission += $play['distributerCommission'];
                        $TotalSuperDistributerCommission += $play['superDistributerCommission'];
                        $TotalAdminCommission = $TotalRetailerCommission + $TotalDistributerCommission + $TotalSuperDistributerCommission;
                    }
                    $total = [];
                    $total['TotalRetailerCommission'] = $TotalRetailerCommission;
                    $total['TotalDistributerCommission'] = $TotalDistributerCommission;
                    $total['TotalSuperDistributerCommission'] = $TotalSuperDistributerCommission;
                    $total['TotalAdminCommission'] = $TotalAdminCommission;
                }
            }
        }elseif(Session::get('role')=="superDistributer"){
            $superDistributer = User::where('_id',new \MongoDB\BSON\ObjectID(Session::get('id')))->get();
            $distributer = User::where('referralId',new \MongoDB\BSON\ObjectID(Session::get('id')))->get();
            foreach($distributer as $dis_user){
                $retailer = User::where('referralId',new \MongoDB\BSON\ObjectID($dis_user['_id']))->get();
                $retailers = [];
                foreach($retailer as $re_user){
                    $retailers[] = new \MongoDB\BSON\ObjectID($re_user['_id']); 
                }   
                $playPoints = Bets::whereIn('retailerId',$retailers)->orderBy('createdAt','DESC')->get();
                // echo "<pre>";print_r($playPoints->toArray());die(); 
                foreach($playPoints as $play){
                    $TotalRetailerCommission += $play['retailerCommission'];
                    $TotalDistributerCommission += $play['distributerCommission'];
                    $TotalSuperDistributerCommission += $play['superDistributerCommission'];
                    $TotalAdminCommission = $TotalRetailerCommission + $TotalDistributerCommission + $TotalSuperDistributerCommission;
                }
                $total = [];
                $total['TotalRetailerCommission'] = $TotalRetailerCommission;
                $total['TotalDistributerCommission'] = $TotalDistributerCommission;
                $total['TotalSuperDistributerCommission'] = $TotalSuperDistributerCommission;
                $total['TotalAdminCommission'] = $TotalAdminCommission;
            }
        }elseif(Session::get('role')=="distributer"){
            $distributer = User::where('_id',new \MongoDB\BSON\ObjectID(Session::get('id')))->get();
            $retailer = User::where('referralId',new \MongoDB\BSON\ObjectID(Session::get('id')))->get();
            $retailers = [];
            foreach($retailer as $re_user){
                $retailers[] = new \MongoDB\BSON\ObjectID($re_user['_id']); 
            }   
            $playPoints = Bets::whereIn('retailerId',$retailers)->orderBy('createdAt','DESC')->get();
            foreach($playPoints as $play){
                $TotalRetailerCommission += $play['retailerCommission'];
                $TotalDistributerCommission += $play['distributerCommission'];
                $TotalSuperDistributerCommission += $play['superDistributerCommission'];
                $TotalAdminCommission = $TotalRetailerCommission + $TotalDistributerCommission + $TotalSuperDistributerCommission;
            }
            $total = [];
            $total['TotalRetailerCommission'] = $TotalRetailerCommission;
            $total['TotalDistributerCommission'] = $TotalDistributerCommission;
            $total['TotalSuperDistributerCommission'] = $TotalSuperDistributerCommission;
            $total['TotalAdminCommission'] = $TotalAdminCommission;
        }elseif(Session::get('role')=="retailer"){
            $retailerd = User::where('_id',new \MongoDB\BSON\ObjectID(Session::get('id')))->get();
            $retailer = User::where('referralId',new \MongoDB\BSON\ObjectID(Session::get('id')))->get();
            $retailers = [];
            foreach($retailer as $re_user){
                $retailers[] = new \MongoDB\BSON\ObjectID($re_user['_id']); 
            } 
            $playPoints = Bets::whereIn('retailerId',$retailers)->orderBy('createdAt','DESC')->get();
            foreach($playPoints as $play){
                $TotalRetailerCommission += $play['retailerCommission'];
                $TotalDistributerCommission += $play['distributerCommission'];
                $TotalSuperDistributerCommission += $play['superDistributerCommission'];
                $TotalAdminCommission = $TotalRetailerCommission + $TotalDistributerCommission + $TotalSuperDistributerCommission;
            }
            $total = [];
            $total['TotalRetailerCommission'] = $TotalRetailerCommission;
            $total['TotalDistributerCommission'] = $TotalDistributerCommission;
            $total['TotalSuperDistributerCommission'] = $TotalSuperDistributerCommission;
            $total['TotalAdminCommission'] = $TotalAdminCommission;
        }
        return view('dashboard',['data'=>$dash,'total'=>$total]);
 
    }
}
