@extends('admin.layouts.adminlte_app')

@section('content')
<!-- general form elements -->
<div class="box" style="border-top: 1px solid #d2d6de;">
    <!-- form start -->
    <form role="form" method="POST" action="{{ url("/admin/tag") }}/{{ $item->id }}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="box-body">
            <div class="form-group">
                <label for="name">标签名</label>
                <input name="name" value="{{ $item->name }}"type="text" class="form-control" id="name" placeholder="标签名">
            </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
            <button type="button" class="btn btn-flat btn-default" onclick="javascript:history.go(-1);">返回</button>

            <button type="submit" class="btn btn-flat btn-primary">提交</button>
        </div>
    </form>
</div>
@endsection