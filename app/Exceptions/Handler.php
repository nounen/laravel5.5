<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
    public function render($request, Exception $exception)
    {
        // 策略 Policy 抛出的异常处理
        if ($exception instanceof AuthorizationException) {
            return response()->view('errors.not_allow', ['message' => $exception->getMessage(), 'message_zh' => '无权查看'], 403);
        }

        // 模型 findOrFail() 异常处理
        if ($exception instanceof ModelNotFoundException) {
            return response()->view('errors.not_found', ['message' => $exception->getMessage(), 'message_zh' => '数据不存在'], 404);
        }

        return parent::render($request, $exception);
    }

    /**
     * 重写未登录跳转处理
     */
    public function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
            ? response()->json(['message' => $exception->getMessage()], 401)
            : redirect()->guest(route('admin.login'));
    }
}
