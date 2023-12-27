<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::guard($guards)->check()) {
            if (Auth::user()->login_type) {

                if(Auth::user()->type == '1'){
                    return redirect('admin/home');
               }else 
               if(Auth::user()->type == '2'){
                    return redirect('admin/');
               }
            
                // case '1':
                //     return redirect('admin/home');
                // case '2':
                //     return redirect('/admin');
                // default:
                //     auth()->logout();
                //     return route('/');
            }
        } 

        return $next($request);
    }
}
