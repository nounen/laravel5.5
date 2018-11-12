@extends('admin.layouts.app')

@section('content')
    @component('admin.common.index', ['base_url' => $base_url, 'fields' => $fields, 'list' => $list])
    @endcomponent
@endsection
