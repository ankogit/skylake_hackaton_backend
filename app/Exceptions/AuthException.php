<?php

namespace App\Exceptions;

use Exception;

class AuthException extends Exception
{

    /**
     * Create a new HTTP response exception instance.
     *
     * @param  string  $message
     * @param  int  $code
     * @param  array  $guards
     */
    public function __construct($message = 'Unauthenticated.', $code = 401, array $guards = [])
    {
        parent::__construct($message, $code);
    }
}
