<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAddressRequest;
use App\Models\Address;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    use AuthorizesRequests;

    public function store(CreateAddressRequest $request)
    {
        $user = Auth::user();

        $address = $user->addresses()->create($request->validated());

        if (! $user->addresses()->where('is_default', true)->exists()) {
            $address->update(['is_default' => true]);
        }

        return redirect()->route('profile.show');
    }

    public function makeAsDefault(Address $address)
    {
        $this->authorize('update', $address);

        $user = Auth::user();

        $user->addresses()
            ->where('is_default', true)
            ->update(['is_default' => false]);

        $address->update(['is_default' => true]);

        return redirect()->route('profile.show');
    }
}
