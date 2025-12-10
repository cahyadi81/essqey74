<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use Response;
use Illuminate\Support\Facades\DB;

class RedirectIfAuthenticated
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
        // if (Auth::guard($guard)->check()) {
        //     if($this->cekApiKey($request->api_key,$guard)) {
        //         return redirect('/home');
        //         // echo $request->api_key;
        //     }
            
        // }
        if (Auth::guard($guard)->check()) {
            // if($request->api_key == "nevermore123") {
                if(Auth::guard($guard)->user()->nik == $request->nik) {
                    if(Hash::check($request->password, Auth::guard($guard)->user()->password)) {
                        return $next($request);
                    }else {
                        return $next($request);
                    }
                }else {
                    return $next($request);
                }
            // }else {
            //     return Response::json($status2,201);
            // } 
        }else{
            return $next($request);
        }

        return $next($request);
    }

    public function updateToken($req) 
    {
        $newToken = str_random(100);
        $nextExprDate = date("d")+2;
        DB::table('api_token')->insert([
            ['token' => $newToken, 'created_at'=>date("Y-m-d H:i:s"), 'expired_at' => date("Y-m")."-".$nextExprDate.date(" H:i:s")]
        ]);
        DB::table('users')
            ->where('email', $req->email)
            ->update(['api_token' => $newToken]
        );

        return $newToken;
    }
}
