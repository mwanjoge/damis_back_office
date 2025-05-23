<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-topbar="light">

    <head>
    <meta charset="utf-8" />
    <title>@yield('title') | DAMIS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.ico')}}">
        @include('layouts.head-css')
        <style>
            .auth-page-wrapper {
                background: url('{{ asset('images/flag.png') }}') no-repeat center fixed;
                background-size: cover;
                background-repeat: no-repeat;
                min-height: 100vh;
                max-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }
        
            .auth-page-wrapper::before {
                min-height: 100vh;
                max-height: 100vh;
                content: "";
                position: absolute;
                inset: 0;
                background: rgba(0, 0, 0, 0.6); /* dark overlay for readability */
                z-index: 0;
            }
        
            /* .auth-page-content {
                position: relative;
                z-index: 1;
            } */
        
            .card {
                margin: auto;
                padding: 20px;
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
            height: 70px;
            width: 20%;
        }

        .header-text h1 {
            font-size: 2rem;
            margin: 0;
            font-weight: bold;
            letter-spacing: 0.2em;
            color: #ffffff;
        }

        .header-text p {
            font-size: 1rem;
            margin: 0;
            opacity: 0.9;
            color: #ffffff;
        }
        </style>
  </head>
    <body class="auth-page-wrapper">

    @yield('content')

    @include('layouts.vendor-scripts')
    </body>
</html>
