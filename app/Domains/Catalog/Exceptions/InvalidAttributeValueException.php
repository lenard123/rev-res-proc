<?php

namespace App\Domains\Catalog\Exceptions;

use Exception;

class InvalidAttributeValueException extends Exception
{
    public function __construct(string $message = 'Invalid attribute value')
    {
        parent::__construct($message);
    }
}