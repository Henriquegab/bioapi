<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class EmailValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $redirectToRoute = null)
    {
        if($request->user()->hasVerifiedEmail()){
            return $next($request);
        }
        else{
            $request->user()->sendEmailVerificationNotification();
            return response()->json([
                'success' => false,
                'message' => 'Email não verificado! Verifique seu email.'
            ], 403);
        }




    }
}
