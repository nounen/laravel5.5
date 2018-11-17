@extends('admin.layouts.app')

@section('content')
    @component('admin.common.search', ['base_url' => $base_url, 'filters' => $filters])
    @endcomponent

    @component('admin.common.index', ['base_url' => $base_url, 'fields' => $fields, 'list' => $list])
        @foreach($list as $item)
            {{-- solt 扩展实现 --}}
            @slot("slot_title_{$item->id}")
                <span style="color: red;">{{ $item->title }}</span>
            @endslot

            @slot("slot_description_{$item->id}")
                <span class="show_3_line" style="color: red;">{{ $item->description }}</span>
            @endslot
        @endforeach
    @endcomponent
@endsection
