<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;
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
    // protected $redirectTo = '/User';

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

        // create our user data for the authentication
        // $userdata = array(
        //     'userName'     => $request->userName,
        //     'password'  => $request->password
        // );
        // echo "<pre>"; print_r($userdata);die;
        // attempt to do the login
        $user = User::where([
            'userName' => $request->userName, 
            'password' => $request->password
        ])->first();

        if ($user) {

            

        } else {        

            return redirect('/');

        }
    }
}
