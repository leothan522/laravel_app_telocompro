<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class Android
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $agent = new Agent();
        //dd(Auth::user());
        if (true /*$agent->isMobile()*/ /*|| Auth::user()->role == 1*/){
            return $next($request);
        }else{
            return redirect()->route('cerrar');
        }

    }
}
