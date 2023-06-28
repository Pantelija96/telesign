<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(isset($request->session()->all()['user'])){
            return $next($request);
        }
        else{
            $request->session()->flush();
            return redirect('/')->with([
                'errorCode' => 1,
                'errorMsg' => 'Not authenticated!'
            ]);
        }
    }
}
