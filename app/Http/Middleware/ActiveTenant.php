<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ActiveTenant
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
        if (tenant('id') && tenant('active') === false) {
          abort(403, 'Tenant is not active. Contact Administrator.');
        }

        return $next($request);
    }
}
