<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registration(Request $req) {
        $this->validate($req, [
            'username' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);

        $new_user = User::create([
            'name' => $req->username,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'user_role_id' => 1
        ]);

        Auth::attempt($req->only('email', 'password'), true);
        return redirect()->route('get_home_page');
    }

    public function login(Request $req) {
        if(!Auth::attempt($req->only('email', 'password'), true)) {
            return redirect()->route('get_login_page')->with('error', 'Invalid credentials');
        }
        if(auth()->user()->user_role_id === 3) {
            if(!$this->user_is_authorized($req->getHost())) {
                Auth::logout();
                throw new AuthorizationException("You are not authorized to access this resource.");
            }
            return redirect()->route('categories.index', ['tenant_subdomain' => auth()->user()->tenant->subdomain]);
        } else {
            return redirect()->route('users.index');
        }
    }

    public function logout(Request $req) {
        Auth::logout();
        return redirect()->route('get_login_page');
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
