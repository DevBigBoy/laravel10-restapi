<?php

namespace App\Exceptions;

use Throwable;
use App\Traits\HttpResponses;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    use HttpResponses;
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        // Handle validation exceptions and return a custom error response
        if ($exception instanceof ValidationException) {
            return $this->error(
                $exception->errors(),    // Pass validation errors as data
                'Invalid data provided', // Custom message
                422                      // HTTP status code for validation errors
            );
        }

        // Use the parent render method for other exceptions
        return parent::render($request, $exception);
    }
}
