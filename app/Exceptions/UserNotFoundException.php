<?php

namespace App\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    public function __construct(?string $message = null, int $code = 0, Exception $previous = null)
    {
        parent::__construct($message ?? 'Пользователь не найден', $code, $previous);
    }
}
