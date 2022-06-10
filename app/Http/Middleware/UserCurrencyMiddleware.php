<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserCurrencyMiddleware
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
        if (! $request->get('currency') && !$request->session()->get('currency')) {
            $clientIP = $request->getClientIp();
            $localCurrency = geoip($clientIP)->getAttribute('currency');

            if($localCurrency) {
                $request->session()->put([
                    'currency' => $localCurrency,
                ]);
            }
        }

        return $next($request);
    }
}
