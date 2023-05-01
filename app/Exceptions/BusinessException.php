<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class BusinessException extends Exception
{
    protected $code = 500;

    public function __construct($message, Throwable $throwable)
    {
        parent::__construct($message,$this->code, $throwable);
    }
}
