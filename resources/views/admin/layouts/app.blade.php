<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CURD</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <script src="{{ asset('js/base.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</head>
<body id="sidebar-effect" class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    {{-- header 隐藏--}}
    @if(isset($hidden_header) && $hidden_header)
    <style>
    .content-wrapper, .main-footer {
        margin-left: 0px;
    }
    </style>
    @else
        @include('admin.layouts.header')
    @endif

    {{-- sidebar 隐藏 --}}
    @if(isset($hidden_sidebar) && $hidden_sidebar)
    @else
        @include('admin.layouts.sidebar')
    @endif

    {{-- 主内容 --}}
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

    {{-- footer 隐藏 --}}
    @if(isset($hidden_footer) && $hidden_footer)
    @else
        @include('admin.layouts.footer')
    @endif
</div>

{{-- common 目录下文件 js 扩展 --}}
@yield('common_js')
@yield('js')

@include('admin.common.error')
</body>
</html>
