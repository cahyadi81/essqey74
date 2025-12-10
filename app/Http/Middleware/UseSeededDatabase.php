<?php

namespace App\Http\Middleware;

use Closure;
use Config;
use DB;

class UseSeededDatabase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
	$db = $request->database;
	//if($db == "pma"){
	//192.206.197.90
	//}else if($db == "demo"){
	
	//}else if($db == "jalusi"){
	
	//}
	
	if($request->database != null || $request->database != ""){
        DB::disconnect(config('database.default'));
        //Config::set('database.default', '');
            //config(['database.connections.demo' => $jalusi ]);
        config(['database.default' => $db ]);
    }
	
	//DB::disconnect('demo');
        // DB::disconnect('mysql');
        return $next($request);
    }
}
