<?php

namespace Softwareseni\Sso\Middleware;

use Closure;
use Softwareseni\Sso\SsoClient;
use Illuminate\Support\Facades\Auth;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->check()) {
            $token = $request->session()->get('token');
            $sso = new SsoClient();
            $data = $sso->user($token);
            if ($data[0]['status'] == false) {
                auth()->guard()->logout();
                $request->session()->invalidate();
            }
            return $next($request);
        }
    }
}
