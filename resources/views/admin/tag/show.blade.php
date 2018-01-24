@extends('admin.layouts.app')

@section('content')
    @component('admin.common.show', ['item_rows' => $item_rows, 'item' => $item])
        {{-- solt 扩展实现 --}}
        @slot("name{$item->id}")
            <span style="color: red;">{{ $item->name }}</span>
        @endslot
    @endcomponent
@endsection