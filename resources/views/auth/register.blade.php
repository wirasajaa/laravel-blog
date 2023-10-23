@extends('auth.partials.app')

@push('content')
    <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
        <img src="{{ asset('admin/images/logos/dark-logo.svg') }}" width="180" alt="">
    </a>
    <p class="text-center">Your Social Campaigns</p>
    @error('server')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @enderror
    <form method="post" action="{{ route('store.user', []) }}">
        @csrf
        <div class="mb-3">
            <label for="inputName" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="inputName"
                value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="inputEmail" class="form-label">Email Address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                placeholder="xxxxx@xxxx.xxx" id="inputEmail" value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="inputPhone" class="form-label">Phone</label>
            <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone"
                placeholder="089652222671" id="inputPhone" value="{{ old('phone') }}">
            @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="inputPass" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                id="inputPass">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="inputConfirmPass" class="form-label">Confirm Password</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                name="password_confirmation" id="inputConfirmPass">
            @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign Up</button>
        <div class="d-flex align-items-center justify-content-center">
            <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
            <a class="text-primary fw-bold ms-2" href="{{ route('login', []) }}">Sign In</a>
        </div>
    </form>
@endpush
