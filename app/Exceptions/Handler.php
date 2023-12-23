<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException as PassportAuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Passport\Exceptions\OAuthServerException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        AuthException::class,
        UnauthorizedException::class,
        OAuthServerException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof ValidationException) {
            return parent::render($request, $e);
        }

        if ($e instanceof AuthException || $e instanceof OAuthServerException) {
            return response()->json([
                'message' => $e->getMessage(),
                'error' => 'Unauthorized.',
            ], 401);
        }
        if ($e instanceof LogicException) {
            return response()->json([
                'message' => $e->getMessage(),
                'error' => 'Sorry, something went wrong.',
            ], $e->getCode());
        }

        if ($e instanceof PassportAuthenticationException) {
            return response()->json([
                'message' => 'You are unauthorized to do this action.',
                'error' => 'Unauthorized.',
            ], 401);
        }

        if ($e instanceof PassportAuthenticationException) {
            return response()->json([
                'message' => 'You are unauthorized to do this action.',
                'error' => 'Unauthorized.',
            ], 401);
        }

        if ($e instanceof AccessDeniedHttpException or $e instanceof AuthorizationException) {
            return response()->json([
                'message' => $e->getMessage(),
                'error' => 'Access denied.',
            ], 403);
        }

        if ($e instanceof QueryException && env('APP_ENV') === 'production') {
            return response()->json([
                'message' => 'Sorry, something went wrong.',
                'error' => 'Query error.',
            ], 400);
        }

        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'message' => 'The resource you are requesting does not exist.',
                'error' => 'Not found.',
            ], 404);
        }

        // Define the response
        $response = [
            'error' => $e->getMessage() ?? 'Sorry, something went wrong.'
        ];

        $response['message'] = 'Sorry, something went wrong.';

        // Default response of 400
        $status = 400;

        // If this exception is an instance of HttpException
        if ($this->isHttpException($e)) {
            // Grab the HTTP status code from the Exception
            $status = $e->getStatusCode();
            return parent::render($request, $e);
        }


        if (env('APP_ENV') != 'production') {
            return parent::render($request, $e);
        }


        // Return a JSON response with the response array and status code
        return response()->json($response, $status);
    }
}
