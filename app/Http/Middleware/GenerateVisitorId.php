<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GenerateVisitorId
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
        
        $visitorId = $request->cookie('visitor_id');
        Log::debug($visitorId);
        if (!$visitorId) {
            $visitorId = Str::uuid()->toString();
            $cookie = cookie('visitor_id', $visitorId, 0, null, null, true, true, false, 'none');
            return $next($request)->cookie($cookie);
        }
        return $next($request);
    }
}
