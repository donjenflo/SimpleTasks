<?php

namespace App\Exceptions;

use DomainException;

class BadConditionException extends DomainException
{
    public int $statusCode = 400;

    public function __construct(string $message = 'Некорректное значение')
    {
        parent::__construct($message);
    }

}
