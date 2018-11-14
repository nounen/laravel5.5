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

    /*!* 重写光标样式 *!*/
    /*.form-control[disabled], fieldset[disabled] .form-control {*/
        /*cursor: auto;*/
    /*}*/

    /* 灰色背景取消 */
    .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
        background-color: inherit;
    }
</style>

<div class="box box-primary">
    <form role="form" class="form-horizontal">
        <div class="box-body">
            @foreach($fields as $key => $field)
                @switch($field['element'])

                    @case('input')
                    <div class="form-group {{getHiddenClass($field)}}">
                        <label for="{{ $key }}"
                               class="col-sm-2 table_title_width control-label">
                            {{ $field['name'] }}:
                        </label>

                        <div class="col-sm-10">
                            <input id="{{ $key }}"
                                   name="{{ $key }}"
                                   value="{{ $item->{$key} }}"
                                   class="form-control"
                                   {!! $field['attribute'] !!}
                                   disabled>
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
                            @foreach($field['options'] as $option)
                            <label>
                                <input name="{{ $key }}"
                                       value="{{ $option['value'] }}"
                                       {!! getCheckedResult($option['value'], $item->$key) !!}
                                       {!! $field['attribute'] !!}
                                       disabled>
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
                                       {!! getCheckedResult($option['value'], $item->$key) !!}
                                       disabled>
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
                                    {!! $field['attribute'] !!}
                                    disabled>

                                @foreach($field['options'] as $option)
                                <option value="{{ $option['value'] }}"
                                    {{-- 多选 OR 单选 --}}
                                    @if(is_array($item->$key))
                                        @foreach($item->$key as $value)
                                        {{ getSelectResult($option['value'], $value) }}
                                        @endforeach
                                    @else
                                        {{ getSelectResult($option['value'], $item->$key) }}
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
                                      {!! $field['attribute'] !!}disabled>{{ $item->{$key} }}</textarea>
                        </div>
                    </div>
                    @break

                    @case('image-single')
                    <div class="form-group">
                        <label for="{{ $key }}"
                               class="col-sm-2 table_title_width control-label">
                            {{ $field['name'] }}:
                        </label>

                        <div class="col-sm-10">
                            <img class="img-responsive"
                                 src="{{ $item->{$key} }}">
                        </div>
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
            <button type="button"
                    class="btn btn-flat btn-default"
                    onclick="javascript:history.go(-1);">
                返回
            </button>
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