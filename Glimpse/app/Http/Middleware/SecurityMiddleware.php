<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;
use Closure;

class SecurityMiddleware
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
        $path = $request->path();
        Log::info("Entering MySecurityMiddleware in handle() at path: " . $path);
        
        $secureCheck = true;
        if ($request->is('/') || $request->is('login') || $request->is('register') || $request->is('welcome') || $request->is('loggingservice') || ('usersrest') || ('jobsrest'))
            $secureCheck = false;
            Log::info($secureCheck ? "SecurityMiddleware in handle().... Needs Security" : "Security Middleware in handle()... No Security Required");
            
            if (session()->get('security') == 'enabled') {
                return $next($request);
            }
            if ($secureCheck) {
                Log::info("Leaving MySecurityMiddleware in handle() doing a redirect to login");
                return redirect('/login');
            }
            
            return $next($request);
    }
}
