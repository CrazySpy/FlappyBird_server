<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;

use Closure;

class RSADecode
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
        $encrypted = $request->input('data');
        $RSAPrivate = openssl_pkey_get_private(file_get_contents(app_path() . "/../key/rsa_1024_priv.pem"));
        if(isset($RSAPrivate) && $RSAPrivate)
        {
            $encrypted = str_replace('%2B', '+', $encrypted);
            $encrypted = base64_decode($encrypted);

            $decrypted = null;
            openssl_private_decrypt($encrypted, $decrypted, $RSAPrivate);
            if(isset($decrypted) && $decrypted)
            {
                $para = json_decode($decrypted);
                Session::put('input', $para);
            }
        }
        return $next($request);
    }
}
