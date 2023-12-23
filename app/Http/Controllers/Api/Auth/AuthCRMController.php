<?php

namespace App\Http\Controllers\Api\Auth;


use Illuminate\Http\Request;

class AuthCRMController extends BaseAuthController
{

    public function login(Request $request)
    {
        $data = [
            'username' => $request->email,
            'password' => $request->password,
            'guard' => 'users'
        ];

        $credentials = $this->buildCredentials($data, 'users');
        $token = $this->proxyLogin($credentials);

        return response()->json(['response_token' => $token], $token['code'] ?? 200);
    }
}
