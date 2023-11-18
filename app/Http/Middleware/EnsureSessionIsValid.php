<?php

namespace App\Http\Middleware;

use Closure;

class EnsureSessionIsValid
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
        $auth = session('auth');
        if ($auth == null) {
            return redirect('/login')->with('warning', 'Sesi telah berakhir, silahkan login kembali');
        }

        return $next($request);
    }
}
