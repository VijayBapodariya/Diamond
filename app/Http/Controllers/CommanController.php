<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Bets;
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
}
