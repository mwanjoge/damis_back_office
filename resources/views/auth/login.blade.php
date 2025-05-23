@extends('layouts.tabler.auth')
@section('title')
    @lang('translation.signin')
@endsection
@section('content')
    <div class="page page-center">
        <!-- auth page content -->
        <div class="auth-page-content mx-auto">
            <div class="container container-tight">
                <header class="header mt-0">
                        <div class="title-area text-center">
                            <img class="img" src="{{ asset('images/emblem.png') }}" alt="Logo" style="height: 150px; width: auto;"> <!-- Replace with your actual logo -->
                            <div class="header-text py-2">
                                <h1 style="font-size: 60px;">&nbsp;&nbsp;&nbsp;D&nbsp;&nbsp;&nbsp;A&nbsp;&nbsp;&nbsp;M&nbsp;&nbsp;&nbsp;I&nbsp;&nbsp;&nbsp;S&nbsp;&nbsp;&nbsp;
                                </h1>
                                <p class="">Document Authentication Management Information System</p>
                            </div>
                        </div>
                    </header>

                    <div class="card card-md">
                        <div class="card-body">
                            <div class="text-center">
                                <p class="text-muted">Sign in to continue.</p>
                            </div>
                            <div class="">
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email', 'admin@gmail.com') }}" id="username" name="email"
                                            placeholder="Enter username">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="float-end">
                                            <a href="{{ route('password.update') }}" class="text-muted">Forgot
                                                password?</a>
                                        </div>
                                        <label class="form-label" for="password-input">Password <span
                                                class="text-danger">*</span></label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password"
                                                class="form-control pe-5 password-input @error('password') is-invalid @enderror"
                                                name="password" placeholder="Enter password" id="password-input"
                                                value="12345678">
                                            <button
                                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                type="button" id="password-addon"><i
                                                    class="ri-eye-fill align-middle"></i></button>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-success w-100" type="submit">Sign In</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
            </div>
            <!-- end row -->
        </div>
    
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/particles.js/particles.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/particles.app.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/password-addon.init.js') }}"></script>
@endsection
