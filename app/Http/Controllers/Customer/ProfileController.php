<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show()
    {
        $user      = auth()->user();
        $addresses = $user->addresses()->orderByDesc('is_default')->get();

        return view('customer.profile', compact('user', 'addresses'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name'  => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone' => ['required', 'regex:/^\+?[\d\s-]{10,15}$/'],
        ]);

        $user->update($data);

        return back()->with('status', 'Profile updated successfully.');
    }
}