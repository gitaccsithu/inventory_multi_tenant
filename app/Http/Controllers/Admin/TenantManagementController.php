<?php

namespace App\Http\Controllers\Admin;

use App\Events\TenantProjectCreated;
use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use App\Traits\DatabaseManagement;
use Illuminate\Http\Request;

class TenantManagementController extends Controller
{
    use DatabaseManagement;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $tenants = Tenant::paginate(10);
        $new_users = User::leftJoin('tenants', 'users.id', '=', 'tenants.user_id')
                    ->whereNull('tenants.user_id')
                    ->select('users.*')
                    ->get();
        if($req->search) {
            $tenants = Tenant::where('subdomain', 'LIKE', '%' . $req->search . '%')->get();
        }
        return view('dashboard.admin.admin_tenants', [
            'tenants' => $tenants,
            'current_page' => 'tenants',
            'new_users' => $new_users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $this->validate($req, [
            'subdomain' => 'required|unique:tenants,subdomain',
            'user_id' => 'required|unique:tenants,user_id'
        ], [
            'subdomain.unique' => 'The subdomain "'. $req->subdomain . '" is already in used.',
            'user_id.unique' => 'The project for the tenant "'. User::find((int)$req->user_id)->email . '" is already created.',
        ]);

        $new_tenant = Tenant::create([
            'subdomain' => $req->subdomain,
            'db_name' => 'tenant_db_' . $req->subdomain,
            'user_id' => $req->user_id
        ]);

        TenantProjectCreated::dispatch($new_tenant);

        return redirect()->back()->with('success', 'The new project for "'. $new_tenant->user->email . '" is successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, Tenant $tenant)
    {
        $tenant->update([
            'subdomain' => $req->subdomain,
        ]);

        if($req->user_role_id == '2') {
            return redirect()->back()->with('success', 'The project of admin "'. $req->username . '" is updated');
        } else {
            return redirect()->back()->with('success', 'The project of tenant "'. $req->username . '" is updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        if($this->drop_tenant_database($tenant)) {
            $tenant->delete();
            return redirect()->back()->with('success', 'Successfully deleted');
        } else {
            return redirect()->back()->with('error', 'Unexpected error occur!');
        }
    }
}
