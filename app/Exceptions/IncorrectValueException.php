<?php

namespace App\Common\Domain\Exceptions;

use DomainException;

class IncorrectValueException extends DomainException
{
    public int $statusCode = 400;

    public function __construct(string $message = 'Некорректное значение')
    {
        parent::__construct($message);
    }

}
