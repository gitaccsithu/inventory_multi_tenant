<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubdomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->checkSubdoamin($request->getHost())) {
            $subdomain = $this->extractSubdomain($request->getHost());

            // Check if the subdomain is registered in your application
            if (!$this->isSubdomainRegistered($subdomain)) {
                abort(404, 'Subdomain not found');
            }

            // Pass the subdomain to the request for later use
            $request->merge(['subdomain' => $subdomain]);
        }

        return $next($request);
    }

    // Helper method to check whether subdomain present or not
    private function checkSubdoamin($host)
    {
        return count(explode('.', $host)) > 2;
    }

    // Helper method to extract subdomain from the host
    private function extractSubdomain($host)
    {
        $segments = explode('.', $host);
        return array_shift($segments);
    }

    // Helper method to check if the subdomain is registered
    private function isSubdomainRegistered($subdomain)
    {
        return Tenant::where('subdomain', $subdomain)->exists();
    }
}
