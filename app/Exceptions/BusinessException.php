<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class BusinessException extends Exception
{
    protected $code = 500;

    public function report(): bool
    {
        return true;
    }

    public function __construct($message, Throwable $throwable = null)
    {
        parent::__construct($message,$this->code, $throwable);
    }
}
