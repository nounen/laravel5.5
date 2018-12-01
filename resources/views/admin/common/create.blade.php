<style>
{{-- 重写 text-align --}}
.form-horizontal .control-label {
    padding-top: 7px;
    margin-bottom: 0;
    text-align: center;
}

/* 避免内容太多把标题挤没了 */
.table_title_width {
    min-width: 40px;
    max-width: 120px;
}
</style>

<div class="box box-primary">
    <form role="form"
          class="form-horizontal"
          enctype="multipart/form-data"
          method="POST"
          action="{{ $base_url }}" >

        {{ csrf_field() }}

        <div class="box-body">
        @foreach($fields as $key => $field)
            @switch($field['element'])
                {{-- 输入框: 输入 颜色选择 日期选择 等等 --}}
                @case('input')
                    @include('admin.common.form.input',[
                        'key' => $key,
                        'name' => $field['name'],
                        'value' => old($key, $field['value']),
                        'attribute' => $field['attribute'],
                    ])
                @break

                {{-- 输入框: 图片上传 --}}
                @case('input-image')
                    @include('admin.common.form.input-image', [
                        'key' => $key,
                        'name' => $field['name'],
                        'value' => old($key, $field['value']),
                    ])
                @break

                {{-- 单选按钮 --}}
                @case('radio')
                    @include('admin.common.form.radio', [
                        'key' => $key,
                        'name' => $field['name'],
                        'value' => old($key, $field['value']),
                        'options' => $field['options'],
                        'attribute' => $field['attribute'],
                    ])
                @break

                {{-- 复选框 --}}
                @case('checkbox')
                    @include('admin.common.form.checkbox', [
                        'key' => $key,
                        'name' => $field['name'],
                        'value' => old($key, $field['value']),
                        'options' => $field['options'],
                        'attribute' => $field['attribute'],
                    ])
                @break

                {{-- 下拉列表 --}}
                @case('select')
                    @include('admin.common.form.select', [
                        'key' => $key,
                        'name' => $field['name'],
                        'value' => old($key, $field['value']),
                        'options' => $field['options'],
                        'attribute' => $field['attribute'],
                    ])
                @break

                {{-- 文本域 --}}
                @case('textarea')
                    @include('admin.common.form.textarea', [
                        'key' => $key,
                        'name' => $field['name'],
                        'value' => old($key, $field['value']),
                        'attribute' => $field['attribute'],
                    ])
                @break

                {{-- wangEditor --}}
                @case('wang-editor')
                    @include('admin.common.form.wang-editor', [
                        'key' => $key,
                        'name' => $field['name'],
                        'value' => old($key, $field['value']),
                    ])
                @break

                {{-- blade 自定义扩展 --}}
                @case('slot')
                    @include('admin.common.form.slot', [
                        'key' => $key,
                    ])
                @break

                {{-- 配置错误 --}}
                @default
                    @include('admin.common.form.default')
            @endswitch
        @endforeach
        </div>

        <div class="box-footer">
            <button type="button" class="btn btn-flat btn-default" onclick="javascript:history.go(-1);">返回</button>

            <button type="submit" class="btn btn-flat btn-primary" id="create_event">提交</button>
        </div>
    </form>
</div>
