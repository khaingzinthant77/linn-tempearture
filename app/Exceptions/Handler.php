<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App;
use Symfony\Component\Debug\Exception\FlattenException;


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
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
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
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {

        // 404 page when a model is not found
        if ($exception instanceof ModelNotFoundException) {
            return response()->view('admin.error.404', [], 404);
        }

        if ($this->isHttpException($exception)) {
            if($exception->getStatusCode() === 403){
               return response()->view('admin.error.403', [], 403);
            }

            if($exception->getStatusCode() === 404){
               return response()->view('admin.error.404', [], 404);
            }

            if($exception->getStatusCode() === 500){
               return response()->view('admin.error.500', [], 500);
            }
        } else {
            // Custom error 500 view on production
            // if (app()->environment() == 'production') {
            //     return response()->view('admin.error.500', [], 500);
            // }
            return parent::render($request, $exception);
        }
    }

}
