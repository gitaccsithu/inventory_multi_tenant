<?php

namespace App\Listeners;

use App\Traits\DatabaseManagement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateTenantDatabase
{
    use DatabaseManagement;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $tenant = $event->tenant;
        // create tenant database
        if (!$this->create_tenant_database($tenant)) {
            throw new \Exception('Error occur while creating "' . $tenant->db_name . '" database');
        }
        // create tenant's categories table
        if (!$this->create_tenant_categories_table($tenant)) {
            throw new \Exception('Error occur while creating categories table for "' . $tenant->db_name . '" database');
        }
        // create tenant's products table
        if (!$this->create_tenant_products_table($tenant)) {
            throw new \Exception('Error occur while creating products table for "' . $tenant->db_name . '" database');
        }
    }
}
