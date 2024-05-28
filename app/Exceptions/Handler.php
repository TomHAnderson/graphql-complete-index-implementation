<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Psr\Log\LogLevel;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<Throwable>, LogLevel::*>
     */
    // phpcs:disable
    protected $levels = [
        //
    ];
    // phpcs:enable

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    // phpcs:disable
    protected $dontReport = [
        //
    ];
    // phpcs:enable

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    // phpcs:disable
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];
    // phpcs:enable

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        /** @psalm-suppress UnusedClosureParam */
        $this->reportable(static function (Throwable $e): void {
        });
    }
}
