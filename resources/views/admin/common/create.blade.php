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
    <form role="form" class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ $base_url }}" >
        {{ csrf_field() }}

        <div class="box-body">
        @foreach($fields as $field)
            @switch($field['element'])
                @case('input')
                    <div class="form-group">
                        <label for="{{ $field['key'] }}" class="col-sm-2 table_title_width control-label">{{ $field['name'] }}:</label>

                        <div class="col-sm-10">
                            <input id="{{ $field['key'] }}"
                                   name="{{ $field['key'] }}"
                                   value="{{ old($field['key']) }}"
                                   {!! $field['attribute'] !!}
                                   class="form-control">
                        </div>
                    </div>
                    @break
                @case('radio')
                    <div class="form-group">
                        <label for="{{ $field['key'] }}" class="col-sm-2 table_title_width control-label">{{ $field['name'] }}:</label>

                        <div class="radio col-sm-10" id="{{ $field['key'] }}">
                            @foreach($field['options'] as $option)
                            <label>
                                <input name="{{ $field['key'] }}"
                                       value="{{ $option['value'] }}"
                                       {!! $field['attribute'] !!}
                                       {{-- 默认选中情况怎么处理 --}}
                                       @if($option['value'] == old($field['key']))checked="checked"@endif>
                                {{ $option['name'] }}
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @break
                @case('checkbox')
                    <div class="form-group">
                        <label for="{{ $field['key'] }}" class="col-sm-2 table_title_width control-label">{{ $field['name'] }}:</label>

                        <div class="checkbox col-sm-10" id="{{ $field['key'] }}">
                            @foreach($field['options'] as $option)
                            <label>
                                <input name="{{ $field['key'] }}[]"
                                       value="{{ $option['value'] }}"
                                       {!! $field['attribute'] !!}
                                       @if($option['value'] == old($field['key']))checked="checked"@endif>
                                {{ $option['name'] }}
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @break
                @case('select')
                    <div class="form-group">
                        <label for="{{ $field['key'] }}" class="col-sm-2 table_title_width control-label">{{ $field['name'] }}:</label>

                        <div class="col-sm-10">
                            <select id="{{ $field['key'] }}"
                                    @if(strpos($field['attribute'], 'multiple'))
                                        name="{{ $field['key'] }}[]"
                                    @else
                                        name="{{ $field['key'] }}"
                                    @endif
                                    {!! $field['attribute'] !!}
                                    class="form-control">


                                @foreach($field['options'] as $option)
                                    <option value="{{ $option['value'] }}"
                                        {{-- 多选 OR 单选 --}}
                                        @if(is_array(old($field['key'])))
                                            @foreach(old($field['key']) as $value)
                                                @if($option['value'] == $value) selected="selected " @endif
                                            @endforeach
                                        @else
                                            @if($option['value'] == old($field['key'])) selected="selected" @endif
                                        @endif
                                    >{{ $option['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @break
                @case('textarea')
                    <div class="form-group">
                        <label for="{{ $field['key'] }}" class="col-sm-2 table_title_width control-label">{{ $field['name'] }}:</label>

                        <div class="col-sm-10">
                            <textarea id="{{ $field['key'] }}"
                                      name="{{ $field['key'] }}"
                                      {!! $field['attribute'] !!}
                                      class="form-control">{{ old($field['key']) }}</textarea>
                        </div>
                    </div>
                    @break
                @case('slot')
                    {{ ${$field['key']} }}
                    @break
                @default
                    <h3>字段元素配置错误: {{ $field['key'] }} !</h3>
            @endswitch
        @endforeach
        </div>

        <div class="box-footer">
            <button type="button" class="btn btn-flat btn-default" onclick="javascript:history.go(-1);">返回</button>

            <button type="submit" class="btn btn-flat btn-primary" id="create_event">提交</button>
        </div>
    </form>
</div>
