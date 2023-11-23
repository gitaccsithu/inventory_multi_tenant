<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class SetTenantDatabase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(auth()->user());
        $tenant = $this->getTenantFromRequest(auth()->user());

        // Set the database connection for the current tenant
        Config::set('database.connections.tenant_db', [
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'database' => $tenant->db_name,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
        ]);

        // Set the default connection to the tenant's database
        DB::setDefaultConnection('tenant_db');

        return $next($request);
    }

    private function getTenantFromRequest(User $user)
    {
        return $user->tenant;
    }
}
