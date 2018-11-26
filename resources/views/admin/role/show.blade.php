@extends('admin.layouts.app')

@section('content')
    @component('admin.common.show', ['fields' => $fields, 'item' => $item])
    @endcomponent
@endsection