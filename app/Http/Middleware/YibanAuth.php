<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class YibanAuth
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
        if(Session::has('userId'))
        {
            return $next($request);
        }

        $appKey = env('YIBAN_APP_KEY');
        $appSecret = env('YIBAN_APP_SECRET');
        $callbackUrl = route('auth');
        $state = rand(1, 1000000);
        $authorizeUrl = 'https://openapi.yiban.cn/oauth/authorize?client_id=' . $appKey . '&redirect_uri=' . $callbackUrl . '&state=' . $state;
        Session::put('YIBAN_OAUTH2_STATE', $state);
        return response()->redirectTo($authorizeUrl);
    }
}
