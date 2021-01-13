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
        $root = false;
        $agent = new Agent();
        if (Auth::user()){
            if (Auth::user()->role == 100){
                $root = true;
            }
        }
        if ($agent->isMobile() || $root){
            return $next($request);
        }else{
            return redirect()->route('cerrar');
        }

    }
}
