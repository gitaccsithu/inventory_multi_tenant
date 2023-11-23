<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\DatabaseManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    use DatabaseManagement;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $users = User::paginate(10);
        if($req->search) {
            $users = User::where('email', 'LIKE', '%' . $req->search . '%')->get();
        }
        return view('dashboard.admin.admin_users', [
            'users' => $users,
            'current_page' => 'users'
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
            'username' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);

        $new_user = User::create([
            'name' => $req->username,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'user_role_id' => $req->user_role_id
        ]);

        if($req->user_role_id == '2') {
            return redirect()->back()->with('success', 'The new admin "'. $req->username . '" is created');
        } else {
            return redirect()->back()->with('success', 'The new tenant "'. $req->username . '" is created');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, User $user)
    {
        $user->update([
            'name' => $req->username,
            'email' => $req->email
        ]);

        if($req->user_role_id == '2') {
            return redirect()->back()->with('success', 'The entry of admin "'. $req->username . '" is updated');
        } else {
            return redirect()->back()->with('success', 'The entry of tenant "'. $req->username . '" is updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // drop the database first if the tenant project is already created
        if($user->tenant) {
            $this->drop_tenant_database($user->tenant);
        }
        if($user->delete()) {
            return redirect()->back()->with('success', 'Successfully deleted');
        } else {
            return redirect()->back()->with('error', 'Unexpected error occur!');
        }
        
    }
}
