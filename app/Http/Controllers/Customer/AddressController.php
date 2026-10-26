<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'area'         => ['required', 'string', 'max:100'],
            'address_line' => ['required', 'string', 'max:255'],
            'city'         => ['required', 'string', 'max:100'],
            'landmark'     => ['nullable', 'string', 'max:255'],
            'is_default'   => ['sometimes', 'boolean'],
        ]);

        $user = auth()->user();

        // If it's the user's first address, force default
        $isFirst = $user->addresses()->count() === 0;
        $isDefault = $isFirst || $request->boolean('is_default');

        DB::transaction(function () use ($user, $data, $isDefault) {
            if ($isDefault) {
                $user->addresses()->update(['is_default' => false]);
            }

            $user->addresses()->create([
                'area'         => $data['area'],
                'address_line' => $data['address_line'],
                'city'         => $data['city'],
                'landmark'     => $data['landmark'] ?? null,
                'is_default'   => $isDefault,
            ]);
        });

        return back()->with('status', 'Address added.');
    }

    public function setDefault(Address $address)
    {
        $this->authorizeAddress($address);

        DB::transaction(function () use ($address) {
            auth()->user()->addresses()->update(['is_default' => false]);
            $address->update(['is_default' => true]);
        });

        return back()->with('status', 'Default address updated.');
    }

    public function destroy(Address $address)
    {
        $this->authorizeAddress($address);

        $wasDefault = $address->is_default;
        $address->delete();

        // If we just deleted the default, promote the next one
        if ($wasDefault) {
            $next = auth()->user()->addresses()->orderBy('id')->first();
            $next?->update(['is_default' => true]);
        }

        return back()->with('status', 'Address removed.');
    }

    private function authorizeAddress(Address $address): void
    {
        abort_unless($address->user_id === auth()->id(), 403);
    }
}