<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-bottom: 40px;
        }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center">
                <a href="#">
                    {{-- <img class="logo-img" src="./images/logo.png" alt="logo"> --}}
                </a>
                <span class="splash-description">Please set new password.</span>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('password.expired') }}">
                    @csrf
                    <div class="form-group">
                        <input id="current_password" type="password" class="form-control form-control-lg @error('current_password') is-invalid @enderror" name="current_password" value="{{ old('current_password') }}" placeholder="Current password" required autofocus>
                        <div class="invalid-feedback">
                            {{ $errors->first('current_password') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" placeholder="New password" required>
                        <div class="invalid-feedback">
                            <span>Password must be at least 8 characters long and contain upper and lower case letters, digits and symbols.</span>
                            <p>{{ $errors->first('password') }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" placeholder="Confirm password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Change Password</button>
                </form>
            </div>
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="{{ asset('/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
 
</html>