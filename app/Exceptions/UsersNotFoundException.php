<?php

namespace App\Exceptions;

use Exception;

class UsersNotFoundException extends Exception
{
    public function __construct(?string $message = null, int $code = 0, Exception $previous = null)
    {
        parent::__construct($message ?? 'Пользователи не найдены', $code, $previous);
    }
}
