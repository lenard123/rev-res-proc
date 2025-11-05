<?php

namespace App\Domains\Core\Exceptions;

use Exception;

class ConflictException extends Exception
{
    protected $message = 'The requested action conflicts with the current resource state.';
    protected $code = 409; // used for response status

    public function __construct(?string $message = null)
    {
        parent::__construct($message ?? $this->message, $this->code);
    }
}