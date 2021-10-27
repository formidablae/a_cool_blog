<?php

namespace App\Exceptions;

use ErrorException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;
use UnexpectedValueException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception) {
        return parent::render($request, $exception);
        if ($exception instanceof AuthorizationException) {
            return response('Unauthorized.', 401);
        } else if ($exception instanceof ModelNotFoundException) {
            return response('Resource not found.', 404);
        } else if ($exception instanceof MethodNotAllowedHttpException) {
            return response('Method not allowed.', 405);
        } else if ($exception instanceof HttpException) {
            return response('Http error.', 409);
        } else if ($exception instanceof UnexpectedValueException) {
            return response('Unexpected value.', 422);
        } else if ($exception instanceof ErrorException) {
            return response('Request error.', 422);
        }
        return parent::render($request, $exception);  // other errors, error code 500
    }
}
