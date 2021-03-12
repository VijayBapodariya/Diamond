<?php

namespace App\Http\Controllers;

use App\Payments;
use App\User;
use App\Winnings;
use App\WinnerIds;
use App\Complaints;
use App\WinnerIdHistoris;
use Illuminate\Http\Request;
use Session;

class AdminController extends Controller
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
        $this->middleware('admin');
        $user = User::where('role', 'Admin')->orderBy('createdAt', 'DESC')->get();
        return view('admin.view', ['data' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo "<pre>";
        // print_r($request->toArray());
        // die();

        $request->validate([
            'name' => 'required',
            'firmName' => 'required',
            'role' => 'required',
            'password' => 'required|numeric',
            'transactionPin' => 'required',
            'referralId' => 'required',
        ]);

        $referral = "";
        $role = "";
        if ($request->role == 1) {
            $referral = $request->referralId;
            $role = "Admin";
        } elseif ($request->role == 3) {
            $referral = $request->referralId;
            $role = "superDistributer";
        } elseif ($request->role == 5) {
            $referral = $request->referralId;
            $role = "distributer";
        } elseif ($request->role == 7) {
            $referral = $request->referralId;
            $role = "retailer";
        }

        $userName = 0;
        // $userName = intval(trim($request->userName,'"'));
        $lastUser = User::where('role', $role)
            ->orderBy('userName', 'DESC')
            ->first();
        $userName = $lastUser['userName'] + 1;

        if ($userName === 0) {
            if ($role === "Admin") {
                $userName = 10001;
            } else if ($role === "superDistributer") {
                $userName = 30001;
            } else if ($role === "distributer") {
                $userName = 50001;
            } else if ($role = r == "retailer") {
                $userName = 70001;
            }
        }
        $v = 0;
        $a = 0;
        $permissions = [];
        foreach ($request->permission as $key => $va) {
            $v = $va;
            $a = $key;
            $permissions[$va] = true;
        }

        // echo "<pre>";
        // print_r($userName);die();
        $user = new User();
        $user->name = $request->name;
        $user->userName = $userName;
        $user->password = $request->password;
        $user->firmName = $request->firmName;
        $user->role = $role;
        $user->isActive = true;
        $user->creditPoit = 0;
        $user->permissions = $permissions;
        $user->transactionPin = $request->transactionPin;
        $user->commissionPercentage = $request->commissionPercentage;
        $user->sharingPercentage = $request->sharingPercentage;
        $user->isLogin = false;
        $user->referralId = $referral;
        $user->save();
        $user = User::where('role', 'Admin')->get();
        return view('admin.view', ['data' => $user]);

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
        $user = User::find($id);
        $data = User::all();
        return view('admin.edit', ['edata' => $user, 'udata' => $data]);
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

        // echo "<pre>";
        // print_r($request->toArray());
        // die();
        $referral = "";
        $role = "";
        if ($request->role == 1) {
            $referral = $request->referralId;
            $role = "Admin";
        } elseif ($request->role == 3) {
            $referral = $request->referralId;
            $role = "superDistributer";
        } elseif ($request->role == 5) {
            $referral = $request->referralId;
            $role = "distributer";
        } elseif ($request->role == 7) {
            $referral = $request->referralId;
            $role = "retailer";
        }

        $permissions = [];
        foreach ($request->permission as $key => $va) {
            $v = $va;
            $a = $key;
            $permissions[$va] = true;
        }

        $user = User::find($id);
        // $user = new User();
        $user->name = $request->name;
        $user->password = $request->password;
        $user->firmName = $request->firmName;
        $user->role = $role;
        $user->isActive = true;
        $user->creditPoit = 0;
        $user->permissions = $permissions;
        $user->transactionPin = $request->transactionPin;
        $user->commissionPercentage = $request->commissionPercentage;
        $user->sharingPercentage = $request->sharingPercentage;
        $user->isLogin = false;
        $user->referralId = $referral;
        $user->save();
        return redirect('admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // echo "<pre>";
        // print_r($id);
        // die();
        $user = User::find($id);
        $user->delete();
        return redirect()->back();
    }

    public function winningPercent()
    {
        $this->middleware('admin');
        $user = Winnings::find('602e55e9a494988def7acc25');
        return view('admin.winningPercent', ['data' => $user]);
    }

    public function percent(Request $request)
    {
        $this->middleware('admin');
        date_default_timezone_set("Asia/Calcutta");
        $startTime = date('H:i',strtotime("9:00:00 pm")) . "<br>";
        $endTime = date('H:i',strtotime("7:00:00 am")) . "<br>";
        $time = date('H:i',time()) . "<br>";
        if ($startTime < $time && $time < $endTime) {
            $request->validate([
                'percent' => 'required|not_in:0|numeric|between:0,99.99',
            ]);
            $user = Winnings::find('602e55e9a494988def7acc25');
            $user->percent = $request->percent;
            $user->save();
            session()->flash('success', 'winning percentage is updated');
        } else {
            session()->flash('success', 'Your');
        }
        
        return view('admin.winningPercent', ['data' => $user]);
    }

    public function Winbyadmin()
    {
        $this->middleware('admin');
        $user = User::where('role', 'retailer')->get();
        $winner = WinnerIds::all();
        foreach($winner as $key => $pay){
            $users = User::where('_id',new \MongoDB\BSON\ObjectID($pay['retailerId']))->first();
            // $payment[$key]['createdAt'] = Carbon::parse( $pay['createdAt'] )->toDayDateTimeString();
            $winner[$key]['userName']=$users['userName'];
        }
        // echo "<pre>";print_r($winner->toArray());die();
        return view('admin.WinnerId', ['data' => $user,'winner'=>$winner]);
    }

    public function winnerIdAdmin(Request $request)
    {
        // echo "<pre>";print_r($request->toArray());die();
        $this->middleware('admin');
        $request->validate([
            'amount' => 'required',
            'percent' => 'required|not_in:0|numeric|between:0,99.99'
        ]);
        $user = new WinnerIds();
        $user->retailerId = new \MongoDB\BSON\ObjectID($request->amount);
        $user->percent = $request->percent;
        $user->save();
        $win = new WinnerIdHistoris();
        $win->retailerId = new \MongoDB\BSON\ObjectID($request->amount);
        $win->percent = $request->percent;
        $win->save();
        session()->flash('success', 'retailer percentage is added');
        return redirect('Winbyadmin');
    }

    public function complaint()
    {
        $Complaints = Complaints::all();
        foreach($Complaints as $key => $pay){
            $users = User::where('_id',new \MongoDB\BSON\ObjectID($pay['retailerId']))->first();
            // $payment[$key]['createdAt'] = Carbon::parse( $pay['createdAt'] )->toDayDateTimeString();
            $Complaints[$key]['userName']=$users['userName'];
        }
        return view('/complaint',['data'=>$Complaints]);
    }

    public function complaintDelete($id)
    {
        $Complaint = Complaints::find($id);
        $Complaint->delete();
        return redirect('/complaint');
    }

    public function chpass()
    {
        return view('changepassword');
    }

    public function chpassword(Request $request)
    {
        $validatedData = $request->validate([
            'opass' => 'required|numeric|min:6',
            'npass' => 'required|numeric|min:6',
            'cpass' => 'required|numeric|min:6',
        ]);

        $password = intval(trim($request->cpass, '"'));
        $user = User::find(Session::get('id'));
        if ($user['password'] == $request->opass) {
            if ($request->opass != $request->npass) {
                if ($request->npass == $request->cpass) {
                    $user->password = $password;
                    $user->save();
                    Session::flush();
                    return redirect('/');
                } else {
                    return back()->with('msg', 'new pass not match....');
                }
            } else {
                return back()->with('msg', 'old pass and new pass match....');
            }
        } else {
            return back()->with('msg', 'old pass not match....');
        }

    }

    public function changepin()
    {
        return view('transactionpin');
    }

    public function chpin(Request $request)
    {
        // echo "<pre>";
        // print_r($request->toArray());
        // die;
        $validatedData = $request->validate([
            'password' => 'required|numeric|min:6',
            'otpass' => 'required|numeric|min:6',
            'ntpass' => 'required|numeric|min:6',
            'ctpass' => 'required|numeric|min:6',
        ]);
        $pass = intval(trim($request->password, '"'));
        $password = intval(trim($request->ctpass, '"'));
        $user = User::find(Session::get('id'));

        if ($user['transactionPin'] == $request->otpass) {
            if ($request->otpass != $request->ntpass) {
                if ($request->ntpass == $request->ctpass) {
                    // $token = Session::get('token');
                    if ($user['password'] == $pass) {
                        $user->transactionPin = $password;
                        $user->save();
                        return back()->with('success', 'Transaction Pin Updated.....');
                    } else {
                        return back()->with('error', 'password is not match');
                    }
                } else {
                    return back()->with('error', 'new pass not match....');
                }
            } else {
                return back()->with('error', 'old pass and new pass match....');
            }
        } else {
            return back()->with('msg', 'old transactionPin pass not match....');
        }
    }

    public function banuser($id, $isActive)
    {
        // echo "<pre>";
        // print_r($isActive);
        // die;
        if ($isActive == 1) {
            $is = 0;
        } else {
            $is = 1;
        }
        $user = User::find($id);
        $user->isActive = $is;
        $user->save();
        return redirect()->back();
    }

    public function get_data(Request $request)
    {

        // echo "<pre>";print_r($request->toArray());die;
        $id = $request->role;
        $output = "";
        if ($id == 1) {
            $output = "<div class='col-sm-6'>
                <input type='hidden' class='form-control ui-autocomplete-input' id='exampleInputUsername1' value='" . Session::get('id') . "' name='referralId' autocomplete='off' placeholder='Plz Enter firmName'>
                </div>";
            echo $output;
        } elseif ($id == 3) {
            $output = "<div class='col-sm-6'>
                <input type='hidden' class='form-control ui-autocomplete-input' id='exampleInputUsername1' value='" . Session::get('id') . "' name='referralId' autocomplete='off' placeholder='Plz Enter firmName'>
                </div>";
            echo $output;
        } elseif ($id == 5) {

            $user = User::where('role', 'superDistributer')->get();

            if ($user != "") {
                foreach ($user as $value) {
                    $data[] = $value;
                }
                // echo "<pre>";print_r($data);die();
                echo "<label class='col-sm-2 offset-lg-1 text-right control-label mt-2'>Referral</label>
                                    <div class='col-sm-6'>
                                        <div class='form-group mb-2'>
                                            <select class='form-control' name='referralId' id='referralId'>
                                            <option selected disabled>Select Super Distributer</option>";
                foreach ($data as $value) {
                    echo "<option value='" . $value['_id'] . "'>" . $value['userName'] . " " . $value['name'] . "</option>";
                }
                echo "</select>
                        </div>
                    </div>";
            }
        } elseif ($id == 7) {
            $user = User::where('role', 'superDistributer')->get();

            if ($user != "") {
                foreach ($user as $value) {
                    $data[] = $value;
                }
                // echo "<pre>";print_r($data);die();
                echo "<option selected disabled>Select super distributer</option>";
                foreach ($data as $value) {
                    $id = $value['_id'];
                    echo "<option value='" . $value['_id'] . "'>" . $value['userName'] . " " . $value['name'] . "</option>";
                }
            }
        }
    }

    public function get_distributer(Request $request)
    {
        $id = $request->role;
        // echo "<pre>";print_r($id);die;

        $user = User::where('role', 'distributer')->get();
        $dis = User::all();
        foreach ($dis as $v) {
            if ($v['referralId'] == $id && $v['role'] == 'distributer') {
                $distributer[] = $v;
            }
        }
        // echo "<pre>";
        // print_r($distributer);
        // die;
        if ($user != "") {
            foreach ($distributer as $value) {
                $data[] = $value;
            }
            // echo "<pre>";print_r($data);die();
            echo "<label class='col-sm-2 offset-lg-1 text-right control-label mt-2'>Referral</label>
                            <div class='col-sm-6'>
                                <div class='form-group mb-2'>
                                    <select class='form-control' name='referralId' id='referralId'>
                                    <option selected disabled>Select distributer</option>";
            foreach ($data as $value) {
                echo "<option value='" . $value['_id'] . "'>" . $value['userName'] . " " . $value['name'] . "</option>";
            }
            echo "</select>
                                </div>
                            </div>";
        }
    }

    public function detail($id)
    {
        $user = User::where('_id', $id)
            ->first();
        $super = User::where('role', 'superDistributer')->get();
        $data = array();
        foreach ($super as $value) {
            if ($id == $value['referralId']) {
                $data[] = $value;
            }
        }
        return view('admin.detail', ['user' => $data, 'data' => $user]);
    }

    public function transfercredit($id)
    {
        $user = User::find($id);
        return view('transfercredit', ['data' => $user]);
    }

    public function transfercredits(Request $request, $id)
    {
        // echo "<pre>";print_r($request->toArray());
        // die();
        $MAC = exec('getmac');
        $MAC = strtok($MAC, ' ');

        $request->validate([
            'amount' => 'required|not_in:0|numeric|gt:0',
            'password' => 'required|not_in:0|numeric|min:5',
        ]);

        if ($request->amount >= 0) {
            if ($request->password == Session::get('transactionPin')) {
                $user = User::find($id);
                if ($user->role == "superDistributer") {
                    if ($user->creditPoint > $request->amount) {
                        session()->flash('msg', 'Check Credit Point! Credit Point is insufficient..');
                        return redirect()->back();
                    }
                    $payment = new Payments();
                    $payment->toId = $id;
                    $payment->fromId = Session::get('id');
                    $payment->creditPoint = intval($request->amount);
                    $payment->macAddress = $MAC;
                    $payment->type = "transfer";
                    $payment->status = "pending";
                    $payment->save();
                    session()->flash('success', 'added transfer creditpoint successfully....');
                    return redirect()->back();
                } else {
                    session()->flash('msg', 'You are not Authorized to Add Credit to this User.');
                    return redirect()->back();
                }
            } else {
                session()->flash('msg', 'Your Transaction PIn is Wrong...');
                return redirect()->back();
            }
        } else {
            session()->flash('msg', 'Please Add Credit Point And Credit Point should not be 0');
            return redirect()->back();
        }
    }

    public function adjustcredit($id)
    {
        $user = User::find($id);
        return view('adjustcredit', ['data' => $user]);
    }

    public function adjustcredits(Request $request, $id)
    {
        // echo "<pre>";print_r($request->toArray());
        // die();
        $MAC = exec('getmac');
        $MAC = strtok($MAC, ' ');

        $request->validate([
            'amount' => 'required|not_in:0|numeric|gt:0',
            'password' => 'required|not_in:0|numeric|min:5',
        ]);

        if ($request->amount >= 0) {
            if ($request->password == Session::get('transactionPin')) {
                $user = User::find($id);
                if ($user->role == "superDistributer") {
                    if ($user->creditPoint < $request->amount) {
                        session()->flash('msg', 'Check Credit Point! Credit Point is insufficient..');
                        return redirect()->back();
                    }
                    $payment = new Payments();
                    $payment->toId = $id;
                    $payment->fromId = Session::get('id');
                    $payment->creditPoint = intval($request->amount);
                    $payment->macAddress = $MAC;
                    $payment->type = "adjustment";
                    $payment->status = "success";
                    $payment->save();
                    $user->creditPoint = $user->creditPoint - $payment->creditPoint;
                    $user->save();
                    session()->flash('success', 'adjust creditpoint successfully....');
                    return redirect()->back();
                } else {
                    session()->flash('msg', 'You are not Authorized to Add Credit to this User.');
                    return redirect()->back();
                }
            } else {
                session()->flash('msg', 'Your Transaction PIn is Wrong...');
                return redirect()->back();
            }
        } else {
            session()->flash('msg', 'Please Add Credit Point And Credit Point should not be 0');
            return redirect()->back();
        }
    }

    public function transfer()
    {
        $user = User::orderBy('userName', 'ASC')->get();
        $pending_accept = Payments::where('toId', Session::get('id'))->where('status', 'pending')->orderBy('createdAt', 'DESC')->get();
        $pending_transfer = Payments::where('fromId', Session::get('id'))->orderBy('createdAt', 'DESC')->get();
        // echo "<pre>";
        // print_r($pending_transfer->toArray());
        // die();
        return view('transfer', ['data' => $user, 'pending_accept' => $pending_accept, 'pending_transfer' => $pending_transfer]);
    }

    public function search(Request $request)
    {
        $user = User::all();
        foreach ($user as $value) {
            if (Session::get('id') == $value['referralId']) {
                if ($request->id == $value['_id']) {
                    echo "<table class='col-md-3'>
                                <tr>
                                    <td>Name</td>
                                    <td>:</td>
                                    <td>" . $value['name'] . "</td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td>:</td>
                                    <td>" . $value['userName'] . "</td>
                                </tr>
                                <tr>
                                    <td>Credit</td>
                                    <td>:</td>
                                    <td>" . number_format($value['creditPoint'], 2) . "</td>
                                </tr>
                                <tr>
                                    <td><a href='transfercredit/" . $value['_id'] . "' class='btn btn-outline-success title='Transfer Credit'>Transfer Credit</a></td>
                                    <td><a href='adjustcredit/" . $value['_id'] . "' class='btn btn-outline-warning' title='Adjust Credit'>Adjust Credit</a></td>
                                </tr>
                            </table>";
                }
            } else {
                if ($request->id == $value['_id']) {
                    echo "<table class='col-md-3'>
                                <tr>
                                    <td>Name</td>
                                    <td>:</td>
                                    <td>" . $value['name'] . "</td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td>:</td>
                                    <td>" . $value['userName'] . "</td>
                                </tr>
                            </table>";
                }
            }
        }
    }

    public function success($id)
    {
        $payment = Payments::find($id);
        $payment->status = "success";
        if ($payment->save()) {
            $user = User::find($payment->toId);
            $user->creditPoint = $user->creditPoint + $payment->creditPoint;
            // echo "<pre>";
            // print_r($user->toArray());
            // die();
            Session::put('creditPoint', $user->creditPoint);
            $user->save();
        }
        session()->flash('success', 'added transfer creditpoint successfully....');
        return redirect()->back();
    }

    public function reject($id)
    {
        $payment = Payments::find($id);
        $payment->status = "reject";
        if ($payment->save()) {
            $user = User::find($payment->fromId);
            $user->creditPoint = $user->creditPoint + $payment->creditPoint;
            // echo "<pre>";
            // print_r($user->toArray());
            // die();
            $user->save();
        }
        session()->flash('msg', 'reject creditpoint successfully....');
        return redirect()->back();
    }

}
