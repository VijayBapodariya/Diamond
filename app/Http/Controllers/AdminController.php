<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;

class AdminController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('admin');
        // $this->middleware('checkAuth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        echo "<pre>";
        print_r($request->toArray());
        die;
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
            
            $user = User::where('role','superDistributer')->get();

            if ($user!="") {
                foreach ($user as $value){
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
            $user = User::where('role','superDistributer')->get();

            if ($user!="") {
                foreach ($user as $value){
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

        $user = User::where('role','distributer')->get();
        $dis = User::all();
            foreach ($dis as $v){   
                if($v['referralId'] == $id && $v['role']=='distributer'){
                    $distributer[] = $v;
                }
            }
        // echo "<pre>";
        // print_r($distributer);
        // die;
            if ($user!="") {
                foreach ($distributer as $value){
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

}
