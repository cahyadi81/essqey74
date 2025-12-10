<?php

namespace App\Http\Middleware;

use Closure;

class ignoreNull
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
        $request->request->remove('id');
        foreach ($request->input() as $key => $value) {
            if (empty($value)) {
                if(is_int($value) == false){
                    $request->request->remove($key);
                }else{
                    $value == 0;
                }
            
            }
        }

        return $next($request);
    }
}
