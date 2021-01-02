<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        // $request->session()->flush();
        if($request->session()->get('role') != 1){
            return redirect('/login')->with('failed_exist','Not authorized!');
        }
        return $next($request);
    }
}
