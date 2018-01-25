@extends('admin.layouts.app')

@section('content')
    @component('admin.common.edit', ['base_url' => $base_url, 'update_rows' => $update_rows, 'item' => $item])
    @endcomponent
@endsection