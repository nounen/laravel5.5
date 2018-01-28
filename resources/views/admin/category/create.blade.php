@extends('admin.layouts.app')

@section('content')
    @component('admin.common.create', ['base_url' => $base_url, 'fields' => $fields])
    @endcomponent
@endsection