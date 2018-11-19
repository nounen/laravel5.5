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

<script>
    // 图片预览
    var loadFile = function(event, id) {
        var output = document.getElementById(id);
        output.src = URL.createObjectURL(event.target.files[0]);
    };
</script>

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
                    <div class="form-group {{ getHiddenClass($field['attribute']) }}">
                        <label for="{{ $key }}"
                               class="col-sm-2 table_title_width control-label">
                            {{ $field['name'] }}:
                        </label>

                        <div class="col-sm-10">
                            <input id="{{ $key }}"
                                   name="{{ $key }}"
                                   value="{{ $item->{$key} }}"
                                   class="form-control"
                                   {!! $field['attribute'] !!} >
                        </div>
                    </div>
                    @break

                    @case('input-image')
                    <div class="form-group">
                        <label for="{{ $key }}"
                               class="col-sm-2 table_title_width control-label">
                            {{ $field['name'] }}:
                        </label>

                        <div class="col-sm-10">
                            <input name="{{ $key }}"
                                   type="file"
                                   accept="image/*"
                                   onchange="loadFile(event, 'input-image-{{ $key }}')"
                                   style="margin-bottom: 15px;">

                            <img id="input-image-{{ $key }}"
                                 src="{{ getAssetUrl($item->{$key}) }}"
                                 class="img-responsive"/>
                        </div>
                    </div>
                    @break

                    @case('radio')
                    <div class="form-group">
                        <label for="{{ $key }}"
                               class="col-sm-2 table_title_width control-label">
                            {{ $field['name'] }}:
                        </label>

                        <div class="radio col-sm-10" id="{{ $key }}">
                            @foreach($field['options']() as $option)
                            <label>
                                <input name="{{ $key }}"
                                       value="{{ $option['value'] }}"
                                        {!! getCheckedResult($option['value'], old($field['key'], $item->$key)) !!}
                                        {!! $field['attribute'] !!} >
                                {{ $option['name'] }}
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @break

                    @case('checkbox')
                    <div class="form-group">
                        <label for="{{ $key }}"
                               class="col-sm-2 table_title_width control-label">
                            {{ $field['name'] }}:
                        </label>

                        <div class="checkbox col-sm-10" id="{{ $key }}">
                            @foreach($field['options'] as $option)
                            <label>
                                <input name="{{ $key }}[]"
                                       value="{{ $option['value'] }}"
                                       {!! $field['attribute'] !!}
                                       @if($option['value'] == $item->{$key})checked="checked"@endif>
                                {{ $option['name'] }}
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @break

                    @case('select')
                    <div class="form-group">
                        <label for="{{ $key }}"
                               class="col-sm-2 table_title_width control-label">
                            {{ $field['name'] }}:
                        </label>

                        <div class="col-sm-10">
                            <select id="{{ $key }}"
                                    name="{{ getSelectName($field) }}"
                                    class="form-control"
                                    {!! $field['attribute'] !!}>

                                @foreach($field['options']() as $option)
                                <option value="{{ $option['value'] }}"
                               {{-- 多选 OR 单选 --}}
                                @if(is_array(old($key, $item->$key)))
                                    @foreach(old($key, $item->$key) as $value)
                                    {{ getSelectResult($option['value'], $value) }}
                                    @endforeach
                                @else
                                    {{ getSelectResult($option['value'], old($key, $item->$key)) }}
                                @endif
                                >{{ $option['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @break

                    @case('textarea')
                    <div class="form-group">
                        <label for="{{ $key }}"
                               class="col-sm-2 table_title_width control-label">
                            {{ $field['name'] }}:
                        </label>

                        <div class="col-sm-10">
                            <textarea id="{{ $key }}"
                                      name="{{ $key }}"
                                      class="form-control"
                                      {!! $field['attribute'] !!}>{{ $item->{$key} }}</textarea>
                        </div>
                    </div>
                    @break

                    {{-- wangEditor --}}
                    @case('wang-editor')
                    <div class="form-group">
                        <label for="{{ $key }}"
                               class="col-sm-2 table_title_width control-label">
                            {{ $field['name'] }}:
                        </label>

                        <div class="col-sm-10">
                            <div id="wang-editor-{{ $key }}"></div>
                        </div>

                        <textarea id="wang-editor-textarea-{{ $key }}"
                                  name="{{ $key }}"
                                  class="hidden">{!! old($key, $item->$key)  !!}</textarea>

                        <script type="text/javascript">
                        // wangEditor 编辑器初始化
                        var E = window.wangEditor;
                        var editor{{ $key }} = new E('#wang-editor-{{ $key }}');
                        var textarea{{ $key }} = $("#wang-editor-textarea-{{ $key }}");

                        // wangEditor 内容变化监测，同步更新到 textarea
                        editor{{ $key }}.customConfig.onchange = function (html) {
                            textarea{{ $key }}.html(html);
                        }

                        // 初始化
                        editor{{ $key }}.create();
                        editor{{ $key }}.txt.html(`{!! old($key, $item->$key)  !!}`);
                        textarea{{ $key }}.html(editor{{ $key }}.txt.html())
                        </script>
                    </div>
                    @break

                    @case('slot')
                    {{ ${$key} }}
                    @break

                    @default
                    <h3>字段元素配置错误: {{ $key }} !</h3>

                @endswitch
            @endforeach
        </div>

        <div class="box-footer">
            <button type="button" class="btn btn-flat btn-default" onclick="javascript:history.go(-1);">返回</button>

            <button type="submit" class="btn btn-flat btn-primary" id="update_event">提交</button>
        </div>
    </form>
</div>

@section('common_js')
<script>
// textarea 高度自适应
$.each($("textarea"), function(i, n){
    // 为什么 + 5: 因为高度还是差一点, 导致出现滚轴
    $(n).css("height", (n.scrollHeight + 5) + "px");
})
</script>
@endsection