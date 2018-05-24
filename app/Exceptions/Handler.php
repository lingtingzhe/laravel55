<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
//    public function render($request, Exception $exception)
//    {
//        return parent::render($request, $exception);
//    }
    // http API 请求错误 返回数据
    public function render($request, Exception $exception)
    {
        if($exception instanceof ModelNotFoundException){
            return response()->json([
                'error'=> 'Resource not found.'
            ],404);
        }
        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    //API 请求资源 判断出未登录， 跳转到 登录页面
    protected function unauthenticated($request, AuthenticationException $exception)
    {
         return !$request->expectsJson() ? response()->json(['message' => 'Unauthenticated.'], 401) : redirect()->guest('api/login');
    }

}
