<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\API\user;
use Response;
use DateTime;
use App\library\api_token;
use Illuminate\Support\Facades\DB;

class TokenController extends Controller
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

	public function updateT($nik,$last_login) {
		$user_login = new user();
		$last_login = date("Y-m-d H:i:s");
		$user_login->update_login($nik,'0',$last_login);
		$user_login->update_first_login($nik,'1',$last_login);
	}
	
	public function updateN($nik,$last_login) {
		$user_login = new user();
		$last_login = date("Y-m-d H:i:s");
		$user_login->uptime_lastlogin($nik,$last_login);
	}
	
    public function cekToken($token) 
    {
		//date_default_timezone_set("Asia/Bangkok");
		// Menambah menit di php
		
        //$token = str_replace("Bearer ","",$token);

        if(explode(" ",$token)[0] == "Bearer"){
            $token = str_replace("Bearer ","",$token);
        }
		
		$expired = DB::table('user')
                    ->select(DB::raw('last_login,
					username,is_login,first_login,
					TIMESTAMPDIFF(SECOND,last_login,NOW()) as `daterange`  

        '))
                    ->where('api_token','=', $token)
                    ->first();
		
		$nik = $expired ? $expired->username : '';
		//$akhir  = new DateTime($expired->last_login);
		//$awal = new DateTime(date("Y-m-d H:i:s")); // waktu sekarang
		//$diff  = $akhir->diff($awal);

		if($expired) {
			//return $expired->daterange." - ".$expired->first_login;
			if($expired->is_login == '1' && $expired->first_login == '0') {
				if($expired->daterange > 3600) {
					//update date and status login
					$this->updateT($nik,$expired->last_login);
					//return $expired->daterange;
					return false;
				}else {
					//update date and status login
					$this->updateN($nik,$expired->last_login);
					//return $expired->daterange;
					return true;
				}
			}else {
				return false;
			}
		}else {
			return $expired->daterange;
			return false;
		}
    }
	
	public function cekTokenForLogout($token) 
    {
        if(config('database.default') == "demo"){
            return true;
        }
                
		$api_token = DB::table('user')
                    ->select(DB::raw('count(username) as jml'))
                    ->where('api_token','=', $token)
                    ->first();
		if($api_token) 
        {
            return true;
        }
        return false;
    }

    public function cekNikToken($nik) 
    {
        $api_token = DB::table('user')
                    ->select(DB::raw('count(username) as jml'))
                    ->where('username', '=', $nik)
                    ->first();
        if($api_token->jml <= 0) 
        {
            return true;
        }
        return false;
    }
	
	public function getNikByToken($token) {
        // $token = str_replace("Bearer ","",$token);
        if(explode(" ",$token)[0] == "Bearer"){
            $token = str_replace("Bearer ","",$token);
        }
        
        $user = DB::table('user')
                    ->select(DB::raw('username, count(username) as jumlah'))
                    ->where('api_token','=', $token)
                    ->first();
		if($user->jumlah < 1) {
			return 0;
		}
		return $user->username;
	}

    public function updateToken($nik) 
    {
		//date_default_timezone_set("Asia/Bangkok");
        $newToken = str_random(100);
        $nextExprDate = date("d")+10;
        if($this->cekNikToken($nik)) 
        {
            DB::table('api_token')
                ->insert([
                        'nik' => $nik,
                        'token' => $newToken, 
                        'created_at'=>date("Y-m-d H:i:s"), 
                        'expired_at' => date("Y-m")."-".$nextExprDate.date(" H:i:s")
                    ]
            );
			
        }
        else 
        {
            DB::table('api_token')
                ->where('nik', $nik)
                ->update([
                        'token' => $newToken, 
                        'created_at'=>date("Y-m-d H:i:s"), 
                        'expired_at' => date("Y-m")."-".$nextExprDate.date(" H:i:s")
                    ]
            );
			
        }
       
        DB::table('user')
            ->where('username', $nik)
            ->update(['api_token' => $newToken]
        );
        $data = [
            'token'=>$newToken
        ];
        return $data;
    }
}
