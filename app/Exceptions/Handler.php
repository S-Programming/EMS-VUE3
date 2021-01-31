<?php

namespace App\Exceptions;

use App\Http\Traits\FailureLogs;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Mockery\Exception\InvalidOrderException;
use Throwable;

class Handler extends ExceptionHandler
{
    use FailureLogs;

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
//        $this->renderable(function (InvalidOrderException $e, $request) {
//            return response()->view('errors.invalid-order', [], 500);
//        });
        $this->renderable(function (Throwable $e) {
            $this->failureLog('Exception Generated', $e->getMessage(), ['code' => $e->getCode(), 'message' => $e->getMessage()]);
            return response(['status' => 'error', 'message' => $e->getMessage()], $e->getCode() ?: 200);
        });
    }
}
