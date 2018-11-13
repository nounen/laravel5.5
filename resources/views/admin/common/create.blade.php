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
                <div class="form-group">
                    <label for="{{ $key }}"
                           class="col-sm-2 table_title_width control-label">
                        {{ $field['name'] }}:
                    </label>

                    <div class="col-sm-10">
                        <input id="{{ $key }}"
                               name="{{ $key }}"
                               value="{{ old($key) }}"
                               class="form-control"
                                {!! $field['attribute'] !!}>
                    </div>
                </div>
                @break

                {{-- 单选按钮 --}}
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
                                    {!! getCheckedResult($option, $field) !!}
                                    {!! $field['attribute'] !!} >
                            {{ $option['name'] }}
                        </label>
                        @endforeach
                    </div>
                </div>
                @break

                {{-- 复选框 --}}
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
                                   {!! getCheckedResult($option, $field) !!}
                                    {!! $field['attribute'] !!} >
                            {{ $option['name'] }}
                        </label>
                        @endforeach
                    </div>
                </div>
                @break

                {{-- 下拉列表 --}}
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

                            @foreach($field['options'] as $option)
                            <option value="{{ $option['value'] }}"
                                {{-- 多选 --}}
                                @if(is_array(old($key)))
                                    @foreach(old($key) as $value)
                                    {{ getSelectResult($option['value'], $value) }}
                                    @endforeach
                                {{-- 单选 --}}
                                @else
                                    {{ getSelectResult($option['value'], old($key)) }}
                                @endif
                            >{{ $option['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @break

                {{-- 文本域 --}}
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
                                {!! $field['attribute'] !!}>{{ old($key) }}</textarea>
                    </div>
                </div>
                @break

                {{-- blade 自定义扩展 --}}
                @case('slot')
                {{ ${$key} }}
                @break

                {{-- 配置错误 --}}
                @default
                <h3>字段元素配置错误: {{ $key }} !</h3>

            @endswitch
        @endforeach
        </div>

        <div class="box-footer">
            <button type="button" class="btn btn-flat btn-default" onclick="javascript:history.go(-1);">返回</button>

            <button type="submit" class="btn btn-flat btn-primary" id="create_event">提交</button>
        </div>
    </form>
</div>
