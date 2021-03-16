<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;

class ReatilerController extends Controller
{
    public function __construct()
    {
        $this->middleware('CheckAuth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = User::where('role', 'retailer')->orderBy('createdAt','DESC')
        //     ->get();
        // foreach ($user as $key => $value){
        //     $refer = User::where('_id',new \MongoDB\BSON\ObjectID($value['referralId']))->first();
        //     $user[$key]['refer']=$refer->userName;
        // }

        if(Session::get('role')=="Admin"){
            $user = User::where('role', 'retailer')->orderBy('createdAt','DESC')->get();
            foreach ($user as $key => $value){
                $refer = User::where('_id',new \MongoDB\BSON\ObjectID($value['referralId']))->first();
                $user[$key]['refer']=$refer->userName;
            }
        }elseif(Session::get('role')=="superDistributer"){
            $distributer = User::where('referralId',new \MongoDB\BSON\ObjectID(Session::get('id')))->where('role', 'distributer')->orderBy('createdAt','DESC')->get();
            foreach($distributer as $dis){
                $user = User::where('referralId',new \MongoDB\BSON\ObjectID($dis['_id']))->get();
                foreach ($user as $key => $value){
                    $refer = User::where('_id',new \MongoDB\BSON\ObjectID($value['referralId']))->first();
                    $user[$key]['refer']=$refer->userName;  
                }
            }
        }elseif(Session::get('role')=="distributer"){
            $user = User::where('referralId',new \MongoDB\BSON\ObjectID(Session::get('id')))->where('role', 'retailer')->orderBy('createdAt','DESC')->get();
            // echo "<pre>";print_r($user->toArray());die;
            foreach ($user as $key => $value){
                $refer = User::where('_id',new \MongoDB\BSON\ObjectID($value['referralId']))->first();
                $user[$key]['refer']=$refer->userName;  
            }
        }
        return view('retailer.index',['data' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
