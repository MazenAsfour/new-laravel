<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;

class dashboardAccess
{
    
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            $userId=Auth::user()->id;
            $checkAdmin =Admin::where("user_id", $userId)->first();
            if(!$checkAdmin){
                abort(403);
            }else{
                return $next($request);
            }
        }else{
            abort("/login");
        }
        
    }
}
