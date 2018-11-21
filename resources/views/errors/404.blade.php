<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Oops! Page not found.</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body id="sidebar-effect" class="hold-transition skin-blue sidebar-mini">
<section class="content">
    <div class="error-page" style="margin-top: 200px;">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
            <h3>
                <i class="fa fa-warning text-yellow"></i> Oops! Page not found.
            </h3>

            <p>
                We could not find the page you were looking for.
                Meanwhile, you may <a href="{{ url('admin') }}">return to dashboard</a> or try using the search form.
            </p>

            <form class="search-form">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search">

                    <div class="input-group-btn">
                        <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                <!-- /.input-group -->
            </form>
        </div>
    </div>
</section>
</body>
