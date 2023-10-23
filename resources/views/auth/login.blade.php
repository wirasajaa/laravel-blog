@extends('auth.partials.app')

@push('content')
    <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
        <img src="{{ asset('admin/images/logos/dark-logo.svg') }}" width="180" alt="">
    </a>
    <p class="text-center">Your Social Campaigns</p>
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    @error('error')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @enderror
    <form action="{{ route('authenticate', []) }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="inputEmail" class="form-label">Username</label>
            <input type="email" class="form-control" id="inputEmail" name="email" value="{{ old('email') }}">
        </div>
        <div class="mb-4">
            <label for="inputPass" class="form-label">Password</label>
            <input type="password" class="form-control" id="inputPass" name="password">
        </div>
        {{-- <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="form-check">
                <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label text-dark" for="flexCheckChecked">
                    Remeber this Device
                </label>
            </div>
            <a class="text-primary fw-bold" href="./index.html">Forgot Password ?</a>
        </div> --}}
        <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
        <div class="d-flex align-items-center justify-content-center">
            <p class="fs-4 mb-0 fw-bold">New to Modernize?</p>
            <a class="text-primary fw-bold ms-2" href="{{ route('register', []) }}">Create an account</a>
        </div>
    </form>
@endpush
