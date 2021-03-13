<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/User';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    public function Login_custom(Request $request)
    {   
        // validate the info, create rules for the inputs
        // echo "<pre>"; print_r($request->toArray());die;
        $validator = $request->validate([
            'userName'    => 'required', // make sure the email is an actual email
            'password' => 'required' // password can only be alphanumeric and has to be greater than 3 characters
        ]);

        $userName = intval(trim($request->userName,'"'));
        $password = intval(trim($request->password,'"'));


        if($userName != "" && $password != ""){
            $user = User::where([
                'userName' => $userName,
                'password' => $password
            ])->first();

            if ($user) {
                $users = User::where('userName',$userName)
                ->first();
                // echo "<pre>";
                // print_r($users['role']);
                // die();
                if(!empty($users)){
                    if($users['role'] == 'Admin'){
                        Session::put('username', $users['userName']);
                        Session::put('name', $users['name']);
                        Session::put('creditPoint', $users['creditPoint']);
                        Session::put('role', $users['role']);
                        Session::put('id', $users['id']);
                        Session::put('transactionPin',$users['transactionPin']);
                        Session::put('permissions',$users['permissions']);
                            return redirect()->intended('/dashboard');
                    }elseif($users['role']=="superDistributer"){
                        Session::put('username', $users['userName']);
                        Session::put('name', $users['name']);
                        Session::put('creditPoint', $users['creditPoint']);
                        Session::put('role', $users['role']);
                        Session::put('id', $users['id']);
                        Session::put('transactionPin',$users['transactionPin']);
                        Session::put('permissions',$users['permissions']);
                            
                            return redirect()->intended('/dashboard');
                    }elseif($users['role']=="distributer"){
                        Session::put('username', $users['userName']);
                        Session::put('name', $users['name']);
                        Session::put('creditPoint', $users['creditPoint']);
                        Session::put('role', $users['role']);
                        Session::put('id', $users['id']);
                        Session::put('transactionPin',$users['transactionPin']);
                        Session::put('permissions',$users['permissions']);
                            return redirect()->intended('/dashboard');
                    }elseif($users['role']=="retailer"){
                        Session::put('username', $users['userName']);
                        Session::put('name', $users['name']);
                        Session::put('creditPoint', $users['creditPoint']);
                        Session::put('role', $users['role']);
                        Session::put('id', $users['id']);
                        Session::put('transactionPin',$users['transactionPin']);
                        Session::put('permissions',$users['permissions']);
                            return redirect()->intended('/dashboard');
                    }else{
                        Session::flush();
                        return redirect()->route('login');
                    }
                }
            } else {        
                return redirect()->route('login');
            }
        }else{
            return redirect()->route('login');
        }
        
    }

    public function doLogout()
    {
        Auth::logout(); // log the user out of our application
        Session::flush(); //
        return Redirect::to('login'); // redirect the user to the login screen
    }

}
