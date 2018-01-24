@extends('admin.layouts.app')

@section('content')
    @include('admin.common.create')
@endsection

@section('js')
<script type="application/javascript">
console.log('js 扩展!');
</script>
@endsection
