<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | Bootstrap Based Admin Template - Material Design</title>
    <!-- Favicon-->
    <link rel="icon" href="{{asset('img/favicon/)}}favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <!-- Bootstrap Core Css -->
    <link href="{{ asset('theme/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('theme/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('theme/plugins/animate-css/animate.css') }}" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="{{ asset('theme/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>{{ config('app.name') }}</b></a>
            <small>LMS</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="msg">{{ __('auth.Login') }}</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <x-input-label for="email" :value="__('auth.Email_Address')" /><br>
                            <!-- <input type="text" class="form-control" id="login" name="login" value="{{ old('login') }}" placeholder="Username" autocomplete="username" required autofocus> -->
                            <input class="mdl-textfield__input @error('email') is-invalid @enderror" type="text" id="email" name="email" value="admin@example.com" required autocomplete="off" autofocus />
                            <x-input-error :message="$errors->get('email') class=" mt-2" />
                            <x-input-error :message="$errors->get('username') class=" mt-2" />
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <x-input-label for="password" :value="__('auth.Password')" />
                            <input type="password" class="form-control" name="password" placeholder="Password" value="password" required>
                            <x-input-error :message="$errors->get('password') class=" mt-2" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink" {{ old('remember') ? 'checked' : '' }}>
                            <label for="rememberme">{{ __('auth.Remember_Me') }}</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">{{ __('Login') }}</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="{{ route('register') }}">{{ __('auth.Register') }}</a>
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="forgot-password.html">{{ __('auth.Forgot_Your_Password?') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="{{ asset('theme/plugins/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('theme/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('theme/plugins/node-waves/waves.js') }}"></script>

    <!-- Validation Plugin Js -->
    <script src="{{ asset('theme/plugins/jquery-validation/jquery.validate.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{-- asset('theme/js/admin.js') --}}"></script>
    <script src="{{-- asset('theme/js/pages/examples/sign-in.js') --}}"></script>
</body>

</html>