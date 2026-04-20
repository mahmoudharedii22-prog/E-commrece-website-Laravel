<x-layouts.app>

    <div class="container py-4">

        <h3 class="mb-4">My Profile</h3>

        <div class="row">

            <!-- User Info -->
            <div class="col-md-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <h5 class="mb-3">User Information</h5>

                        <div class="row">

                            <div class="col-md-6 mb-2">
                                <strong>Name:</strong> {{ $user->name }}
                            </div>

                            <div class="col-md-6 mb-2">
                                <strong>Email:</strong> {{ $user->email }}
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Add Address -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <h5 class="mb-3">Add New Address</h5>

                        <form method="POST" action="{{ route('addresses.store') }}">
                            @csrf

                            <div class="row">

                                <div class="col-md-6">
                                    <label class="form-label">Label</label>

                                    <select name="label" class="form-select mb-2 rounded-pill">
                                        <option value="" disabled selected>Select label</option>
                                        <option value="home">Home</option>
                                        <option value="work">Work</option>
                                        <option value="parents">Parents</option>
                                    </select>
                                </div>
                                <!-- Country -->
                                <div class="col-md-6">
                                    <label class="form-label">Country</label>
                                    <input name="country" class="form-control mb-2 rounded-pill" placeholder="Country">
                                </div>


                                <!-- City -->
                                <div class="col-md-6">
                                    <label class="form-label">City</label>
                                    <input name="city" class="form-control mb-2 rounded-pill" placeholder="City">
                                </div>

                                <!-- State -->
                                <div class="col-md-6">
                                    <label class="form-label">State</label>
                                    <input name="state" class="form-control mb-2 rounded-pill" placeholder="State">
                                </div>

                                <!-- Street -->
                                <div class="col-md-6">
                                    <label class="form-label">Street</label>
                                    <input name="street" class="form-control mb-2 rounded-pill" placeholder="Street">
                                </div>

                                <!-- Building / Floor / Apartment -->
                                <div class="col-md-6">
                                    <label class="form-label">Building</label>
                                    <input name="building" class="form-control mb-2 rounded-pill"
                                        placeholder="Building">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Floor</label>
                                    <input name="floor" class="form-control mb-2 rounded-pill" placeholder="Floor">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Apartment</label>
                                    <input name="apartment" class="form-control mb-2 rounded-pill"
                                        placeholder="Apartment">
                                </div>

                                <!-- Phone -->
                                <div class="col-md-12">
                                    <label class="form-label">Phone</label>
                                    <input name="phone" class="form-control mb-2 rounded-pill" placeholder="Phone">
                                </div>

                            </div>

                            <button class="btn btn-primary w-100 rounded-pill mt-2">
                                Save Address
                            </button>

                        </form>

                    </div>
                </div>
            </div>

            <!-- Addresses List -->
            <!-- Addresses List -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <h5 class="mb-3">My Addresses</h5>

                        @foreach ($addresses as $address)
                            <div class="border rounded p-2 mb-2 d-flex justify-content-between align-items-center">
                                <div>
                                    <div>
                                        {{ $address->country }}, {{ $address->city }}
                                    </div>
                                    <small>{{ $address->street }}</small>

                                    @if ($address->is_default)
                                        <span class="badge bg-success">Default</span>
                                    @endif
                                </div>
                                @if (!$address->is_default)
                                    <form method="POST" action="{{ route('addresses.default', $address->id) }}">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-primary">
                                            Make Default
                                        </button>
                                    </form>
                                @endif

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

    </div>

</x-layouts.app>
