@extends('layouts.master-without-nav')
@section('title')
    @lang('translation.signin')
@endsection
@section('content')
    <div class="auth-page-wrapper pt-5">
     

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-2 mb-0 text-white-50">
                            <header class="header">
                                <div class="title-area">
                                    <img src="{{ asset('images/emblem.png') }}" alt="Logo"> <!-- Replace with your actual logo -->
                                    <div class="header-text">
                                        <h1 >&nbsp;&nbsp;&nbsp;D&nbsp;&nbsp;&nbsp;A&nbsp;&nbsp;&nbsp;M&nbsp;&nbsp;&nbsp;I&nbsp;&nbsp;&nbsp;S&nbsp;&nbsp;&nbsp;</h1>
                                        <h5 class="text-white">Document Authentication Management Information System</h5>
                                    </div>
                                </div>
                            </header>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-1">

                            <div class="card-body p-2">
                                <div class="text-center mt-2">
                                    <h5 class="text-white">Welcome Back !</h5>
                                    <p class="text-muted">Sign in to continue.</p>
                                </div>
                                <div class="p-2 mt-4">
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

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Sign In</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->


                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
        <style>
            .auth-page-wrapper {
                background: url('{{ asset('images/flag.png') }}') no-repeat center center fixed;
                background-size: cover;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                position: relative;
            }
        
            .auth-page-wrapper::before {
                content: "";
                position: absolute;
                inset: 0;
                background: rgba(0, 0, 0, 0.6); /* dark overlay for readability */
                z-index: 0;
            }
        
            .auth-page-content {
                position: relative;
                z-index: 1;
            }
        
            .card {
                margin: auto;
            padding: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
            color: #fff;
            }
        
            .btn-success {
                background-color: #157347; /* Tanzania green */
                border-color: #157347;
            }
        
            .btn-success:hover {
                background-color: #105c38;
                border-color: #105c38;
            }
        
            .footer {
                z-index: 2;
                position: relative;
            }

            .header {
            z-index: 3;
            position: relative;
            padding: 20px 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .header .title-area {
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
            gap: 15px;
        }

        .header img {
            height: 100px;
        }

        .header-text h1 {
            font-size: 2rem;
            margin: 0;
            font-weight: bold;
            letter-spacing: 0.3em;
            color: #ffffff;
        }

        .header-text p {
            font-size: 1rem;
            margin: 0;
            opacity: 0.9;
            color: #ffffff;
        }
        </style>
        
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/particles.js/particles.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/particles.app.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/password-addon.init.js') }}"></script>
@endsection
