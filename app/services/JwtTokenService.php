<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Config;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtTokenService
{

    public function getToken()
    {
        $user = User::where('email', Config::get('app.apiEmail'))->first();

        $token = JWTAuth::fromUser($user);

        $headers = ['Authorization' => 'Bearer ' . $token];

        return $token;
    }

    public function getHeaderForTest()
    {
        $user = User::where('email', Config::get('app.apiEmail'))->first();

        // dd(Config::get('app.apiEmail'));

        $token = JWTAuth::fromUser($user);

        // dd($token);

        $headers = ['Authorization' => 'Bearer ' . $token];

        return $headers;
    }
    public function getHeaderForTestApi()
    {
        $user = User::where('email', Config::get('app.apiEmail'))->first();



        $token = JWTAuth::customClaims(['context' => 'api'])->fromUser($user);

        $headers = ['Authorization' => 'Bearer ' . $token];


        return $headers;
    }

}


