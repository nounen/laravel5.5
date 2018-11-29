@extends('admin.layouts.app')

@section('content')
    @component('admin.common.index', ['base_url' => $base_url, 'fields' => $fields, 'list' => $list])
        @foreach($list as $item)
            {{-- slot 扩展实现 --}}
            @slot("slot_name_{$item->id}")
                <span style="color: red;">{{ $item->name }}</span>
            @endslot
        @endforeach
    @endcomponent
@endsection
