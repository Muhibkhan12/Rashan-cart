<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    // ---------- Customer registration ----------

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'min:3', 'max:100'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone'    => ['required', 'regex:/^\+?[\d\s-]{10,15}$/'],
            'area'     => ['required', 'string', 'max:100'],
            'address'  => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
            'terms'    => ['accepted'],
        ]);

        $customerRoleId = Role::where('name', 'customer')->value('id');

        if (! $customerRoleId) {
            return back()->withErrors([
                'email' => 'customer role missing from roles table.',
            ]);
        }

        $user = User::create([
            'role_id'  => $customerRoleId,
            'name'     => $data['name'],
            'email'    => $data['email'],
            'phone'    => $data['phone'],
            'password' => $data['password'],
            'status'   => 'active',
        ]);

        $user->addresses()->create([
            'area'         => $data['area'],
            'address_line' => $data['address'],
            'city'         => 'Karachi',
            'is_default'   => true,
        ]);

        return redirect()->route('login')
            ->with('status', 'Account created successfully. Please log in.');
    }

    // ---------- Invitation activation ----------

    public function showInvite()
    {
        return view('auth.invite');
    }

    public function activate(Request $request)
    {
        $data = $request->validate([
            'code'     => ['required', 'string'],
            'name'     => ['required', 'string', 'min:3'],
            'phone'    => ['required', 'regex:/^\+?[\d\s-]{10,15}$/'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        ]);

        $invite = Invitation::where('code', $data['code'])
            ->whereNull('used_at')
            ->first();

        if (! $invite || ($invite->expires_at && $invite->expires_at->isPast())) {
            throw ValidationException::withMessages([
                'code' => 'This invitation code is invalid or expired.',
            ]);
        }

        $user = User::create([
            'role_id'  => $invite->role_id,
            'name'     => $data['name'],
            'email'    => $invite->email,
            'phone'    => $data['phone'],
            'password' => $data['password'],
            'status'   => 'active',
        ]);

        $invite->update(['used_at' => now()]);

        return redirect()->route('login')
            ->with('status', 'Account activated. Please log in.');
    }
}