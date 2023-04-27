<?php

namespace App\Exceptions;

use App\Helpers\ResponseMapper;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class ApiException extends Exception
{
    /**
     * Report the exception.
     */
    public function report(): bool
    {
        return true;
    }
 
    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request)
    {
        return ResponseMapper::error([
            'message' => $this->message
        ], 'Something went wrong.', 500);
    }
}
