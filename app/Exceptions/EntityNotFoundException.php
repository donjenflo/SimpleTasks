<?php

namespace App\Common\Domain\Exceptions;

use DomainException;

class EntityNotFoundException extends DomainException
{
    public function __construct(string $message = 'Объект не найден')
    {
        parent::__construct($message);
    }
}
