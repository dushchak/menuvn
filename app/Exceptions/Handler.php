<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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


    /*
    * Моя переадресация с 419 ошибки на .... /login
    * https://laravel.ru/forum/viewtopic.php?id=2947
    */
    // public function render($request, Exception $exception)
    // {
    //     foreach ($request->server as $k => $val){
    //         //if ($k == "REDIRECT_STATUS" && $val == 200){ // original string
    //         if ($k == "REDIRECT_STATUS" && $val == 419){
    //             return redirect('/login');
    //         }
    //     }

    //     return parent::render($request, $exception);
    // }
}
