<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = 'nb'; // Default to Norwegian Bokmål
        
        // Check if user is authenticated and has a locale preference
        if (Auth::check() && Auth::user()->locale) {
            $locale = Auth::user()->locale;
            // Update session to match user preference
            Session::put('locale', $locale);
        }
        // Otherwise, check for session locale
        elseif (Session::has('locale')) {
            $locale = Session::get('locale');
        }
        
        // Set the application locale
        App::setLocale($locale);

        return $next($request);
    }
}
