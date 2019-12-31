<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use UserAuth;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        if (!UserAuth::isAuth()) {
            if ($request->isMethod('post')) {
                return response()->json([
                    'success' => false,
                    'title' => 'Помилка',
                    'message' => 'Для продовження необхідно авторизуватись!'
                ], 401);
            } else {
                echo view('login');
                exit;
            }
        } else {
            return $next($request);
        }
    }
}
