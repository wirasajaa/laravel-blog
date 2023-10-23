<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function register()
    {
        return view('auth.register');
    }

    public function storeUser(Request $req)
    {
        $validated = $req->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email|email:dns',
            'phone' => 'required|numeric|min:11',
            'password' => [
                'required', 'confirmed', Password::min(7)->numbers()->letters()
            ]
        ]);
        if (User::where('slug', Str::slug($validated['name'], '-'))->first()) {
            return redirect()->back()->withInput()->withErrors('name', 'Name has been used!');
        } else {
            $validated['slug'] = Str::slug($validated['name'], '-');
        }

        try {
            DB::beginTransaction();
            $user = User::create($validated);
            DB::commit();
            return redirect()->route('login')->with('success', 'Successfully register, please login');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['server' => config('app.env') == 'local' ? $th->getMessage() : 'Registration is failed!']);
        }
    }
    public function authenticate(Request $req)
    {
        $credentials = $req->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            $req->session()->regenerate();
            $role = Auth::user()->role;

            switch ($role) {
                case 'admin':
                    return redirect()->intended(route('dashboard'));
                    break;
                case 'auhtor':
                    return "is Author";
                    break;
                case 'user':
                    return "is User";
                    break;

                default:
                    return "You not have access!";
                    break;
            }
        }
        return redirect()->back()->withErrors(['error' => 'The provided credentials do not match our records.'])->onlyInput('email');
    }
    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect()->route('login');
    }
}
