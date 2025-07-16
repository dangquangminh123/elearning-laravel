<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;


class Authenticate extends Middleware
{

    protected function unauthenticated($request, array $guards)
    {

        throw new AuthenticationException(
            'Unauthenticated.',
            $guards,
            $this->redirectTo($request, !in_array('students', $guards))
        );

    }
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request, $isAdmin = true)
    {

        if (!$request->expectsJson()) {
            if (!$isAdmin) {
                return route('clients.login');
            }
            return route('login');
        }
    }
}
