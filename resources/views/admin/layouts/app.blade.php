<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CURD</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="{{ asset('css/adminlte.css') }}" rel="stylesheet">
</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
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

    <div class="content-wrapper">
        <section class="content-header">
            @if(isset($hidden_sidebar) && $hidden_sidebar)
            @else
                <h1>
                {{ $title }}
                </h1>
            @endif
        </section>

        <section class="content">
            @yield('content')
        </section>
    </div>

    @if(isset($hidden_footer) && $hidden_footer)
        {{-- 设置不需要 footer --}}
    @else
        @include('admin.layouts.footer')
    @endif
</div>

<script src="{{ asset('js/adminlte.js') }}"></script>
{{-- common 目录下文件 js 扩展 --}}
@yield('common_js')

@yield('js')

@include('admin.common.error')
</body>
</html>
