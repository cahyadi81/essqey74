<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Datatables;

use App\API\user as User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('user.monitoring');
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function monitoring()
    {
        $data_all = User::all();

        $data_login = User::where('is_login','1')->get();
        $jml_user_login = count($data_login);
        $persen_jml_user_login = round(($jml_user_login / count($data_all)) * 100,2);

        $data_logout = User::where('is_login','0')->get();
        $jml_user_logout =count($data_logout);
        $persen_jml_user_logout = round(($jml_user_logout / count($data_all)) * 100,2);
        return view('user/monitoring',
        compact('data_login','jml_user_login','persen_jml_user_login','data_logout','jml_user_logout','persen_jml_user_logout'));
    }
}
