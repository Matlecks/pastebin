<?php

namespace App\Exceptions;

use Exception;

class PastesNotFoundException extends Exception
{
    public function __construct(?string $message = null, int $code = 0, Exception $previous = null)
    {
        parent::__construct($message ?? 'Пасты не найдены', $code, $previous);
    }
}
