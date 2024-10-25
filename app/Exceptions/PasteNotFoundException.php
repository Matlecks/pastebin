<?php

namespace App\Exceptions;

use Exception;

class PasteNotFoundException extends Exception
{
    public function __construct(?string $message = null, int $code = 0, Exception $previous = null)
    {
        parent::__construct($message ?? 'Паста не найдена', $code, $previous);
    }
}
