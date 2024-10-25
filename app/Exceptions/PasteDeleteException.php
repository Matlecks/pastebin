<?php

namespace App\Exceptions;

use Exception;

class PasteDeleteException extends Exception
{
    public function __construct(?string $message = null, int $code = 0, Exception $previous = null)
    {
        parent::__construct($message ?? 'Не удалось удалить пасту', $code, $previous);
    }
}
