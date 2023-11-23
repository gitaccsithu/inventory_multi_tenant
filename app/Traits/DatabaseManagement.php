<?php
// app/Traits/DatabaseManagement.php

namespace App\Traits;

use App\Models\Tenant;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

trait DatabaseManagement 
{
    public function create_tenant_database(Tenant $tenant) {
        if ($tenant) {
            DB::statement("CREATE DATABASE {$tenant->db_name} CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci");
            return true;
        } else {
            return false;
        }
    }

    public function drop_tenant_database(Tenant $tenant) {
        if ($tenant) {
            DB::statement("DROP DATABASE {$tenant->db_name}");
            return true;
        } else {
            return false;
        }
    }

    public function create_tenant_categories_table(Tenant $tenant) {
        if ($tenant) {
            $default_config = config('database.connections.mysql');
            $default_config['database'] = $tenant->db_name;
            config([ 'database.connections.tenant_db' => $default_config ]);

            Schema::connection('tenant_db')->create('categories', function(Blueprint $table){
                $table->id();
                $table->string('name', 1000);
                $table->timestamps();
            });
            return true;
        } else {
            return false;
        }
    }

    public function create_tenant_products_table(Tenant $tenant) {
        if ($tenant) {
            $default_config = config('database.connections.mysql');
            $default_config['database'] = $tenant->db_name;
            config([ 'database.connections.tenant_db' => $default_config ]);

            Schema::connection('tenant_db')->create('products', function(Blueprint $table){
                $table->id();
                $table->foreignId('category_id')->constrained()->onDelete('cascade');
                $table->string('name', 1000);
                $table->decimal('price', 20, 10);
                $table->integer('quantity');
                $table->timestamps();
            });
            return true;
        } else {
            return false;
        }
    }
}