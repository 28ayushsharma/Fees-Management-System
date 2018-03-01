<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class SuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(Auth::guest()){
            return redirect("admin");
        }else{
            if(Auth::user()->user_role == config('constants.SUPER_ADMIN')){   
                return $next($request);
            }else{
                $request->session()->flash('status', 'danger');
                $request->session()->flash('msg', 'Your are not authorised.');
                return redirect("admin/class");
            }
        }
    }
}
