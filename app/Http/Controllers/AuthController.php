<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        if(Session::has('userId'))
        {
            return response()->redirectTo(route('index'));
        }

        $code = $request->input('code');
        $state = $request->input('state');
        $trueState = Session::get('YIBAN_OAUTH2_STATE');
        if($state != $trueState) return 'wrong state';
        $appKey = env('YIBAN_APP_KEY');
        $appSecret = env('YIBAN_APP_SECRET');
        $redirectUrl = route('auth');

        $accessApiUrl = 'https://openapi.yiban.cn/oauth/access_token';

        if(isset($code) && $code)
        {
            $postParam = array(
                'client_id' => $appKey,
                'client_secret' => $appSecret,
                'code' => $code,
                'redirect_uri' => $redirectUrl
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $accessApiUrl);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postParam);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = json_decode(curl_exec($ch));
            curl_close($ch);
            if(isset($result->userid) && $result->userid)
            {
                Session::put('userId', $result->userid);
                return response()->redirectTo(route('index'));
            }
        }
        return 'Authenticate failed';
    }
}
