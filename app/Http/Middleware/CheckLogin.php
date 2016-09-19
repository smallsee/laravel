<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLogin{

    public function handle(Request $request,Closure $next){

        $http_referer = $_SERVER['HTTP_REFERER'];

        $member  = $request->session()->get('member','');
        if ($member == ''){
            return redirect('/login?return_url='. urlencode($http_referer));
        }

        return $next($request);

    }


}