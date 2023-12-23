<?php

namespace App\Http\Controllers\Api\Auth;

use App\Exceptions\AuthException;
use GuzzleHttp\Utils;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class BaseAuthController extends Controller
{
    private const AUTH_ROUTE = '/oauth/token';


    /**
     * @param  array  $args
     * @param  string  $grantType
     *
     * @return mixed
     */
    public function buildCredentials(array $args = [], string $guard = 'users', string $grantType = 'password')
    {
        $args = collect($args);
        $credentials = $args->except(['directive', 'administration'])->toArray();
        $credentials['client_id'] = config("authentication.$guard.id");
        $credentials['client_secret'] = config("authentication.$guard.secret");
        $credentials['provider'] = $guard;
        $credentials['grant_type'] = $grantType;

        return $credentials;
    }

    public function proxyLogin(array $data)
    {
        $authFullApiUrl = config('app.url').self::AUTH_ROUTE;

        $headers = [
            'HTTP_ACCEPT' => 'application/json',
            'HTTP_ACCEPT_LANGUAGE' => config('app.locale'),
        ];

        $request = Request::create($authFullApiUrl, 'POST', $data, [], [], $headers);
        $response = App::handle($request);

        $content = Utils::jsonDecode($response->getContent(), true);

        // If the internal request to the oauth token endpoint was not successful we throw an exception
        if (!$response->isSuccessful()) {
            throw new AuthException($content['message'], 401);
        }

        return $content;
    }
}
