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
          action="{{ $base_url }}/{{ $item->id }}" >

        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="box-body">
            @foreach($fields as $key => $field)
                @switch($field['element'])
                    @case('input')
                        @include('admin.common.form.input',[
                             'key' => $key,
                             'name' => $field['name'],
                             'value' => $item->$key,
                             'attribute' => $field['attribute'],
                         ])
                    @break

                    @case('input-image')
                        @include('admin.common.form.input-image', [
                           'key' => $key,
                           'name' => $field['name'],
                           'value' => old($key, $item->$key),
                        ])
                    @break

                    @case('radio')
                        @include('admin.common.form.radio', [
                            'key' => $key,
                            'name' => $field['name'],
                            'value' => old($key, $item->$key),
                            'options' => $field['options'],
                            'attribute' => $field['attribute'],
                        ])
                    @break

                    @case('checkbox')
                        @include('admin.common.form.checkbox', [
                            'key' => $key,
                            'name' => $field['name'],
                            'value' => old($key, $item->$key),
                            'options' => $field['options'],
                            'attribute' => $field['attribute'],
                        ])
                    @break

                    @case('select')
                        @include('admin.common.form.select', [
                            'key' => $key,
                            'name' => $field['name'],
                            'value' => old($key, $item->$key),
                            'options' => $field['options'],
                            'attribute' => $field['attribute'],
                        ])
                    @break

                    @case('textarea')
                        @include('admin.common.form.textarea', [
                            'key' => $key,
                            'name' => $field['name'],
                            'value' => old($key, $item->$key),
                            'attribute' => $field['attribute'],
                        ]);
                    @break

                    {{-- wangEditor --}}
                    @case('wang-editor')
                        @include('admin.common.form.wang-editor', [
                            'key' => $key,
                            'name' => $field['name'],
                            'value' => old($key, $item->$key),
                        ])
                    @break

                    @case('slot')
                        @include('admin.common.form.slot', [
                            'key' => $key,
                        ])
                    @break

                    @default
                        @include('admin.common.form.default')
                @endswitch
            @endforeach
        </div>

        <div class="box-footer">
            <button type="button" class="btn btn-flat btn-default" onclick="javascript:history.go(-1);">返回</button>

            <button type="submit" class="btn btn-flat btn-primary" id="update_event">提交</button>
        </div>
    </form>
</div>
