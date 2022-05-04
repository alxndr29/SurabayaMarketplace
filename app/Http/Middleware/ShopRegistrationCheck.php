<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopRegistrationCheck
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
        $count = DB::table('shop')->where('users_id', Auth::user()->id)->count();
        if($count == 0){
            return redirect('shop/registration');
        }else{
            return $next($request);
        }
    }
}
