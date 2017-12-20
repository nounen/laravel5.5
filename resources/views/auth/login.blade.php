@extends('layouts.adminlte_app', ['hidden_header' => true, 'hidden_footer' => true, 'hidden_sidebar' => true])

@section('content')
<div class="login-box">
    @if (count($errors) > 0)
        {{--@@foreach($errors->toArray() as $key => $error)--}}
            {{--@if(count($error) == 1)--}}
            {{--<script>--}}
            {{--var ele =$("input[name='{{$key}}']");--}}
            {{--ele.after("<span class='help-block'><strong>{{$error[0]}}</strong></span>");--}}
            {{--ele.parent().addClass('has-error');--}}
            {{--</script>--}}
            {{--@endif--}}
        {{--@@endforeach--}}

        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{--<h5> <i class="icon fa fa-ban"></i> Alert! </h5>--}}
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="login-logo">
        <p>某某管理系统</p>
    </div>

    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" placeholder="Password" name="password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        {{--
        <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                Facebook</a>
            <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                Google+</a>
        </div>
        <!-- /.social-auth-links -->
        --}}

        <div class="social-auth-links text-center">
            <p>
                <a href="http://localhost:8000/password/reset" class="btn btn-link">Forgot Your Password? </a>
            </p>
        </div>
    </div>
    <!-- /.login-box-body -->
</div>
@endsection