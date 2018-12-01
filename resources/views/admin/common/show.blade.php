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

/* 灰色背景取消 */
.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    background-color: inherit;
}
</style>

<div class="box box-primary">
    <div role="form"
          class="form-horizontal">

        <div class="box-body">
            @foreach($fields as $key => $field)
                @switch($field['element'])
                    @case('input')
                        @include('admin.common.form.input',[
                             'key' => $key,
                             'name' => $field['name'],
                             'value' => $item->$key,
                             'attribute' => "{$field['attribute']} disabled",
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
                            'attribute' => "{$field['attribute']} disabled",
                        ])
                        @break

                    @case('checkbox')
                        @include('admin.common.form.checkbox', [
                            'key' => $key,
                            'name' => $field['name'],
                            'value' => old($key, $item->$key),
                            'options' => $field['options'],
                            'attribute' => "{$field['attribute']} disabled",
                        ])
                        @break

                    @case('select')
                        @include('admin.common.form.select', [
                            'key' => $key,
                            'name' => $field['name'],
                            'value' => old($key, $item->$key),
                            'options' => $field['options'],
                            'attribute' => "{$field['attribute']} disabled",
                        ])
                        @break

                    @case('textarea')
                        @include('admin.common.form.textarea', [
                            'key' => $key,
                            'name' => $field['name'],
                            'value' => old($key, $item->$key),
                            'attribute' => "{$field['attribute']} disabled",
                        ])
                        @break

                    {{-- wangEditor --}}
                    @case('wang-editor')
                        @include('admin.common.form.wang-editor', [
                            'key' => $key,
                            'name' => $field['name'],
                            'value' => old($key, $item->$key),
                            'from' => 'show', // show, index, create, edit
                        ])
                        @break

                    @case('slot')
                        @include('admin.common.form.slot', [
                            'key' => $key,
                        ])
                        @break

                    @case('show-single-image')
                        @include('admin.common.form.show-single-image', [
                            'key' => $key,
                            'value' => $item->$key,
                        ])
                        @break

                    @default
                        @include('admin.common.form.default', [
                            'key' => $key,
                            'element' => $field['element'],
                        ])
                @endswitch
            @endforeach
        </div>

        <div class="box-footer">
            <button type="button" class="btn btn-flat btn-default" onclick="javascript:history.go(-1);">返回</button>
        </div>
    </div>
</div>
