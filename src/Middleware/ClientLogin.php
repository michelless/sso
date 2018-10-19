<?php

namespace Softwareseni\Sso\Middleware;

use Closure;
use Softwareseni\Sso\SsoClient;
use Illuminate\Support\Facades\Auth;

class ClientLogin
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
        if (!Auth::check()) {
            $sso = new SsoClient();
            return $sso->redirect();
        }
    }
}
