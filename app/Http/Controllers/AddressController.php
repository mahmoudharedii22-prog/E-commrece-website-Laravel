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
        $user->addresses()->create($request->validated());

        return redirect()->route('profile.show');
    }

    public function makeAsDefault(Address $address)
    {
        $this->authorize('update', $address);
        Auth::user()->addresses()->update(['is_default' => false]);
        $address->update(['is_default' => true]);

        return redirect()->route('profile.show');
    }
}
