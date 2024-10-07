@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $pageTitle }}</h4>
                </div>
                <div class="card-body">
                @if (session('success') || session('message'))
    <div class="alert alert-{{ session('alert-type', 'success') }} alert-dismissible fade show" role="alert">
        {{ session('success') ?? session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

                    <form class="row g-3" method="POST" action="{{ $user ? route('users.update', $user->id) : route('users.store') }}">
                        @csrf
                        @if($user)
                            @method('PUT') <!-- Use PUT for updates -->
                        @endif

                        <!-- First Name -->
                        <div class="col-md-4">
                            <label class="form-label" for="first_name">First Name</label>
                            <input class="form-control @error('first_name') is-invalid @enderror" type="text" name="first_name" placeholder="Enter first name" value="{{ old('first_name', $user ? $user->first_name : '') }}">
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-4">
                            <label class="form-label" for="last_name">Last Name</label>
                            <input class="form-control @error('last_name') is-invalid @enderror" type="text" name="last_name" placeholder="Enter last name" value="{{ old('last_name', $user ? $user->last_name : '') }}">
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div class="col-md-4">
                            <label class="form-label" for="username">Username</label>
                            <div class="input-group">
                                <span class="input-group-text">@</span>
                                <input class="form-control @error('username') is-invalid @enderror" 
                                    type="text" 
                                    name="username" 
                                    placeholder="Enter username"
                                    autocomplete="off"
                                    value="{{ old('username', $user ? $user->username : '') }}">
                            </div>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-md-4">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" placeholder="Enter email" value="{{ old('email', $user ? $user->email : '') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="col-md-4">
                            <label class="form-label" for="password">Password</label>
                            <input class="form-control @error('password') is-invalid @enderror" 
                                type="password" 
                                name="password" 
                                placeholder="Enter password" 
                                autocomplete="new-password"
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Confirmation -->
                        <div class="col-md-4">
                            <label class="form-label" for="password_confirmation">Re-enter Password</label>
                            <input class="form-control @error('password_confirmation') is-invalid @enderror" 
                                type="password" 
                                name="password_confirmation" 
                                placeholder="Re-enter password" 
                                autocomplete="new-password"
                            >
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="col-md-4">
                            <label class="form-label" for="address">Address</label>
                            <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" placeholder="Enter address" value="{{ old('address', $user ? $user->address : '') }}">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- City -->
                        <div class="col-md-4">
                            <label class="form-label" for="city">City</label>
                            <input class="form-control @error('city') is-invalid @enderror" type="text" name="city" placeholder="Enter city" value="{{ old('city', $user ? $user->city : '') }}">
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Zipcode -->
                        <div class="col-md-4">
                            <label class="form-label" for="zipcode">Zipcode</label>
                            <input class="form-control @error('zipcode') is-invalid @enderror" type="text" name="zipcode" placeholder="Enter zipcode" value="{{ old('zipcode', $user ? $user->zipcode : '') }}">
                            @error('zipcode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Country -->
                        <div class="col-md-4">
                            <label class="form-label" for="country_id">Country</label>
                            <select class="form-select @error('country_id') is-invalid @enderror" name="country_id">
                                <option selected disabled value="">Choose country...</option>
                                <option value="1" {{ (old('country_id', $user ? $user->country_id : '') == 1) ? 'selected' : '' }}>United States</option>
                                <option value="2" {{ (old('country_id', $user ? $user->country_id : '') == 2) ? 'selected' : '' }}>Canada</option>
                            </select>
                            @error('country_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">{{ $user ? 'Update' : 'Submit' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const userTypeSelect = document.querySelector("#userType");
    const userRoleSelect = document.querySelector("#userRole");

    function toggleRoleSelect(disabled) {
        userRoleSelect.disabled = disabled;
    }

    toggleRoleSelect(userTypeSelect.value === "0");

    userTypeSelect.addEventListener("change", function () {
        toggleRoleSelect(this.value === "0");
    });
</script>
@endpush