<?php

namespace App\Http\Controllers\PesanHO;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Datatables;

class PesanHOController extends Controller
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
    public function form_send()
    {
        return view('pesan_ho/send');
    }
}
