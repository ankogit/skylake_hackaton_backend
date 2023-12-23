<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Auth\LoginAuthRequest;
use App\Http\Requests\Auth\RegisterAuthRequest;
use App\Http\Requests\Auth\SocialAuthRequest;
use App\Http\Resources\Auth\AccessTokenAuth;
use App\Http\Resources\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class AuthController extends BaseAuthController
{

    /**
     * Login
     *
     */
    public function login(LoginAuthRequest $request): AccessTokenAuth
    {
        $credentials = $this->buildCredentials([
            'username' => $request->email,
            'password' => $request->password,
        ]);

        $token = $this->proxyLogin($credentials);
        return new AccessTokenAuth($token);
    }

    /**
     * Logout
     *
     */
    public function logout(Request $request)
    {
        $accessToken = auth()->user()->token();

        $token = $request->user()->tokens->find($accessToken);
        $token->revoke();
        return response(['message' => 'You have been successfully logged out.'], 200);
    }

    /**
     * Register
     *
     */
    public function register(RegisterAuthRequest $request): AccessTokenAuth
    {
        $input = $request->input();
        $input['password'] = Hash::make($request['password']);
        $user = User::create($input);

        $credentials = $this->buildCredentials([
            'username' => $user->email,
            'password' => $request['password'],
        ]);

        $token = $this->proxyLogin($credentials);
        return new AccessTokenAuth($token);
    }

    /**
     * Get Profile
     *
     */
    public function profile(): Profile
    {
        return new Profile(auth('api')->user());
    }

    /**
     * Social Login
     *
     */
    public function socialAuth(SocialAuthRequest $request): AccessTokenAuth
    {
        $credentials = $this->buildCredentials([
            'social_provider' => $request->get('provider'),
            'token' => $request->get('token'),
            'secret' => $request->get('secret') ?? null,
            'invite_code' => $request->get('invite_code') ?? null,
        ], 'clients', 'social_grant');
        $token = $this->proxyLogin($credentials);
        return new AccessTokenAuth($token);
    }
}
