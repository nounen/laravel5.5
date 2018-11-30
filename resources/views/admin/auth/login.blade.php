@extends('admin.layouts.app', ['hidden_header' => true, 'hidden_footer' => true, 'hidden_sidebar' => true])

@section('content')
<div class="login-box" style="margin: 10% auto">
    <div class="login-logo">
        <p></p>
    </div>

    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form method="POST" action="{{ url('admin/login') }}">
            {{ csrf_field() }}

            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                </div>

                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </div>
        </form>

        <div class="social-auth-links text-center">
            <p>
                <a href="{{ url('admin/password/reset') }}" class="btn btn-link">Forgot Your Password? </a>
            </p>
        </div>
    </div>
</div>
@endsection