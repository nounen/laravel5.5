@extends('admin.layouts.app')

@section('content')
    {{--@include('admin.common.create')--}}

    @component('admin.common.create', ['base_url' => $base_url, 'create_rows' => $create_rows])

        @slot('slot')
        <div class="form-group has-success">
            <label class="control-label col-sm-2" for="inputSuccess">
                <i class="fa fa-check"></i> 扩展元素:
            </label>

            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputSuccess" placeholder="Enter ...">
                <span class="help-block">Help block with success</span>
            </div>
        </div>
        @endslot
    @endcomponent
@endsection

@section('js')
<script type="application/javascript">
console.log('js 扩展! 比如表单校验哇!');
</script>
@endsection
