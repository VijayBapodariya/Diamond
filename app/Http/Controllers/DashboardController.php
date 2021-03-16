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

class DashboardController extends Controller
{
    public function index()
    {
        $dash = [];
        $dash['users'] = User::where('role','Admin')->count();
        $dash['superDistributer'] = User::where('role','superDistributer')->count();
        $dash['distributer'] = User::where('role','distributer')->count();
        $dash['retailer'] = User::where('role','retailer')->count();
        $dash['showOnPlayer'] = User::where('role','retailer')->where('isLogin',true)->count();

        return view('dashboard',['data'=>$dash]);
 
    }
}
