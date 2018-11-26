@extends('admin.layouts.app')

@section('content')
    @component('admin.common.edit', ['base_url' => $base_url, 'fields' => $fields, 'item' => $item])
    @endcomponent
@endsection