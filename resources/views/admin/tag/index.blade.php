@extends('admin.layouts.app')

@section('content')
    @component('admin.common.index', ['base_url' => $base_url, 'table_permissions' => $table_permissions, 'table_rows' => $table_rows, 'table_list' => $table_list])
    @endcomponent
@endsection