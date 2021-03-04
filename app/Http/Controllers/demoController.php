<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class demoController extends Controller
{
    public function index(){
        $data = User::where('userName',10001)->get();
        echo "<pre>";
        print_r($data->toArray());
        die();
    }
}
