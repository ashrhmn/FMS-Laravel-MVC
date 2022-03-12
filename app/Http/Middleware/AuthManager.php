<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Token;

class AuthManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->session()->get('token');
        $userToken = Token::where('value', $token)->first();
        if ($userToken && $userToken->user->role == 'Manager') {
            return $next($request);
        }
        // $request->session()->put('token', null);
        return redirect()->route('auth.signin');
    }
}
