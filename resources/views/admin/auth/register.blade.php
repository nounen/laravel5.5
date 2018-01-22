@extends('admin.layouts.app', ['hidden_header' => true, 'hidden_footer' => true, 'hidden_sidebar' => true])

@section('content')
    <style>
        .login-box-body, .register-box-body {
            padding: 35px;
        }
    </style>

    <div class="register-box">
        {{--@include("layouts.adminlte_error")--}}

        <div class="register-logo">
            <b>Admin</b>LTE
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Register a new membership</p>

            <form class="form-horizontal" method="POST" action="{{ route('admin.register') }}">
                {{ csrf_field() }}

                <div class="form-group has-feedback">
                    <input id="name" type="text" class="form-control" placeholder="name" name="name" value="{{ old('name') }}" required autofocus>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input id="email" type="email" class="form-control" placeholder="email" name="email" value="{{ old('email') }}" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input id="password" type="password" class="form-control" placeholder="password" name="password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input id="password-confirm" type="password" class="form-control" placeholder="password" name="password_confirmation" required>
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            {{--
            <div class="social-auth-links text-center">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
                    Facebook</a>
                <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
                    Google+</a>
            </div>
            --}}

            <a href="{{ route('admin.login') }}" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
    </div>
@endsection