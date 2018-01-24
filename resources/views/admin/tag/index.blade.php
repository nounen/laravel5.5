@extends('admin.layouts.app')

@section('content')
    @component('admin.common.index', ['base_url' => $base_url, 'table_permissions' => $table_permissions, 'table_rows' => $table_rows, 'table_list' => $table_list])
        @foreach($table_list as $item)
            {{-- solt 扩展实现 --}}
            @slot("name{$item->id}")
                <span style="color: red;">{{ $item->name }}</span>
            @endslot
        @endforeach
    @endcomponent
@endsection