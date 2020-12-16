<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Throwable;

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
        $this->renderable(function (AccessDeniedHttpException  $e, $request) {
            return $this->returnJsonEsceptionResponse($e, $request);
        });
    }

    private function returnJsonEsceptionResponse(Throwable $e, $request) {

        if ($request->expectsJson()) {
            $statusCode = (method_exists($e, 'getStatusCode')) ? $e->getStatusCode() : 500;
            $message = $e->getMessage();
            $payload = [];
            $headers = (method_exists($e, 'getHeaders')) ? $e->getHeaders() : [];
            return respondWithError($payload, $message, $statusCode)->withHeaders($headers);
        }
    }
}
