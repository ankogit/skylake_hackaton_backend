<?php

namespace App\Exceptions;

use Exception;

class LogicException extends Exception
{

    /**
     * Create a new HTTP response exception instance.
     *
     * @param  string  $message
     * @param  int  $code
     */
    public function __construct(string $message = 'Logic error', int $code = 400)
    {
        parent::__construct($message, $code);
    }
}
