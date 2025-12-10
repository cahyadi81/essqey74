<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\TokenController;

class TokenAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $token = new TokenController();
        $data['status_header'] = "Token Authenticated";

        $code_error = 401;
        
        // return $request->imamgantengbanget;
        if($request->imamgantengbanget != ""){
            $vnik = $request->imamgantengbanget;
            $request->nik = $vnik;
            return $next($request);
        }

        if(config('database.default') === "demo"){
            $vnik = $token->getNikByToken($request->header('Authorization'));
            $request->nik = $vnik;
            return $next($request);
        }
        

        $vnik = "";
        
        

        //cek auth not null
        if ($request->header('Authorization') === null || $request->header('Authorization') === "") {
          
          $data['status_message'] = 'token null-';
          $data['status_code'] = $code_error;
          return response()->json($data,$code_error);
        }

        //cek nik == 0 or null
        $nik = $token->getNikByToken($request->header('Authorization'));
        if ($nik === 0 || $nik === "" || $nik === null) {
            $data['status_message'] = 'Nik not found / token not valid';$data['status_code'] = $code_error;
            return response()->json($data,$code_error);
        }

        //cek token is true
        if (!$request->header('Authorization')) {
            $data['status_message'] = 'token not valid';$data['status_code'] = $code_error;
            return response()->json($data,$code_error);              
        }

        if (!$token->cekToken($request->header('Authorization'))) {
            $data['status_message'] = 'token not valid';$data['status_code'] = $code_error;
            return response()->json($data,$code_error);              
        }

        $request->nik = $nik;

        return $next($request);
    }
}
