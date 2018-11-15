<style>
{{-- 文字2行显示多余部分隐藏 --}}
.show_2_line {
    max-width: 500px;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}
</style>

@extends('admin.layouts.app')

@section('content')
    @component('admin.common.index', ['base_url' => $base_url, 'fields' => $fields, 'list' => $list])
        @foreach($list as $item)
            {{-- solt 扩展实现 --}}
            @slot("slot_title_{$item->id}")
                <span style="color: red;">{{ $item->title }}</span>
            @endslot

            @slot("slot_description_{$item->id}")
                <span class="show_2_line" style="color: red;">{{ $item->description }}</span>
            @endslot
        @endforeach
    @endcomponent
@endsection
