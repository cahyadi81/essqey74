<?php

namespace App\Http\Controllers\master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\master\principles;
use App\User;
use Response;
use App\library\api_token;
use Auth;
use Illuminate\Support\Facades\DB;


class PrincipleController extends Controller
{
	public function index()
	{

		$api_token = DB::table('api_token')->where("token",Auth::guard('api')->user()->api_token)->first();
		// return Response::json($api_token->token,500);
		if ($api_token->expired_at > date("Y-m-d H:i:s")) {
            $principles=principles::all();
			return Response::json($principles,200);
        }else {
			return Response::json("token_expired",500);
		}
		
	}

	public function store()
	{
		$principles=new principles;
		$principles->author=Input::get('nm_principle_in');
		$principles->text=Input::get('nm_principle_eng');
		$success=$principles->save();
	 
		if(!$success)
		{
	       	return Response::json("error saving",500);
		}
	    return Response::json("success",201);
	}

	public function show($id)
	{
		$principles=principles::find($id);
		if(is_null($principles))
		{
		    return Response::json("not found",404);
		}
	 
		return Response::json($principles,200);
	}
}
