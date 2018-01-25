<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link href="{{ asset('css/adminlte.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @if(isset($hidden_header) && $hidden_header)
        {{-- 设置不需要 header : 左侧菜单隐藏--}}
        <style>
            .content-wrapper, .main-footer {
                margin-left: 0px;
            }
        </style>
    @else
        @include('admin.layouts.header')
    @endif

    @if(isset($hidden_sidebar) && $hidden_sidebar)
        {{-- 设置不需要 sidebar --}}
    @else
        @include('admin.layouts.sidebar')
    @endif

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            {{--
            <ol class="breadcrumb">
                <li>
                    <a href="#">
                        <i class="fa fa-dashboard"></i> Home
                    </a>
                </li>
                <li class="active">Dashboard</li>
            </ol>
            --}}

            @if(isset($hidden_sidebar) && $hidden_sidebar)
            @else
                <h1>
                {{ $title }} <!-- small>Control panel</small -->
                </h1>
            @endif
        </section>

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @if(isset($hidden_footer) && $hidden_footer)
        {{-- 设置不需要 footer --}}
    @else
        @include('admin.layouts.footer')
    @endif

    {{--@include('admin.layouts.sidebar_right')--}}

    <!-- TODO: 不知道这块干嘛用的 -->
{{--
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg">
        control-sidebar-bg
    </div>
--}}
</div>
<!-- ./wrapper -->

<script src="{{ asset('js/adminlte.js') }}"></script>
@yield('js')

@include('admin.common.error')
</body>
</html>
