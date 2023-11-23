<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuthenticatedTenantWithSubdomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!$this->user_is_authorized($request->getHost())) {
            throw new AuthorizationException("You are not authorized to access this resource.");
        }
        return $next($request);
    }

    // return false if the user is not admin and try to access other user's subdomain
    private function user_is_authorized($host) {
        //get subdomain
        $segments = explode('.', $host);
        $url_subdomain = array_shift($segments);

        return (auth()->user()->tenant->subdomain === $url_subdomain) &&
                (auth()->user()->user_role_id === 3);
    }
}
