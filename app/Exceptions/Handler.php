<?php

namespace App\Exceptions;

use App\Helpers\ResponseMapper;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Redirect;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (AuthenticationException $e, $request) {
            if ($request->is('api/*')) {
                return ResponseMapper::error($e->getMessage(), "Unauthenticated.",401);
            }
        });
        $this->renderable(function (BusinessException $e, $request) {
            if (!$request->is('api/*')) {
                return back()->withInput()->with('business_exception',$e->getMessage());
            }
        });
    }
}
