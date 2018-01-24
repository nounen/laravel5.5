@extends('admin.layouts.app')

@section('content')
    @component('admin.common.create', ['base_url' => $base_url, 'create_rows' => $create_rows])
    @endcomponent
@endsection