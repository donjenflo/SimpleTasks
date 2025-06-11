<?php

namespace App\Exceptions;

use DomainException;

class EntityNotFoundException extends DomainException
{
    public int $statusCode = 404;

    public function __construct(string $message = 'Объект не найден')
    {
        parent::__construct($message);
    }
}
