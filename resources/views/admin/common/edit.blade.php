<style>
    {{-- 重写 text-align --}}
.form-horizontal .control-label {
        padding-top: 7px;
        margin-bottom: 0;
        text-align: center;
    }
</style>

<div class="box box-primary">
    <form role="form" class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ $base_url }}/{{ $item->id }}" >
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="box-body">
            @foreach($update_rows as $row)
                @switch($row['element'])
                    @case('input')
                    <div class="form-group">
                        <label for="{{ $row['key'] }}" class="col-sm-2 control-label">{{ $row['name'] }}:</label>

                        <div class="col-sm-10">
                            <input id="{{ $row['key'] }}"
                                   name="{{ $row['key'] }}"
                                   value="{{ $item->{$row['key']} }}"
                                   {!! $row['attribute'] !!}
                                   class="form-control">
                        </div>
                    </div>
                    @break
                    @case('radio')
                    <div class="form-group">
                        <label for="{{ $row['key'] }}" class="col-sm-2 control-label">{{ $row['name'] }}:</label>

                        <div class="radio col-sm-10" id="{{ $row['key'] }}">
                            @foreach($row['options'] as $option)
                            <label>
                                <input name="{{ $row['key'] }}"
                                       value="{{ $option['value'] }}"
                                       {!! $row['attribute'] !!}
                                       {{-- 默认选中情况怎么处理 --}}
                                       @if($option['value'] == $item->{$row['key']})checked="checked"@endif>
                                {{ $option['name'] }}
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @break
                    @case('checkbox')
                    <div class="form-group">
                        <label for="{{ $row['key'] }}" class="col-sm-2 control-label">{{ $row['name'] }}:</label>

                        <div class="checkbox col-sm-10" id="{{ $row['key'] }}">
                            @foreach($row['options'] as $option)
                            <label>
                                <input name="{{ $row['key'] }}[]"
                                       value="{{ $option['value'] }}"
                                       {!! $row['attribute'] !!}
                                       @if($option['value'] == $item->{$row['key']})checked="checked"@endif>
                                {{ $option['name'] }}
                            </label>
                            @endforeach
                        </div>
                    </div>
                    @break
                    @case('select')
                    <div class="form-group">
                        <label for="{{ $row['key'] }}" class="col-sm-2 control-label">{{ $row['name'] }}:</label>

                        <div class="col-sm-10">
                            <select id="{{ $row['key'] }}"
                                    @if(strpos($row['attribute'], 'multiple'))
                                    name="{{ $row['key'] }}[]"
                                    @else
                                    name="{{ $row['key'] }}"
                                    @endif
                                    {!! $row['attribute'] !!}
                                    class="form-control">
                                @foreach($row['options'] as $option)
                                <option value="{{ $option['value'] }}"
                                        @if($option['value'] == $item->{$row['key']})checked="checked"@endif>
                                    {{ $option['name'] }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @break
                    @case('textarea')
                    <div class="form-group">
                        <label for="{{ $row['key'] }}" class="col-sm-2 control-label">{{ $row['name'] }}:</label>

                        <div class="col-sm-10">
                            <textarea id="{{ $row['key'] }}"
                                      name="{{ $row['key'] }}"
                                      {!! $row['attribute'] !!}
                                      class="form-control">{{ $item->{$row['key']} }}</textarea>
                        </div>
                    </div>
                    @break
                    @case('slot')
                    {{ ${$row['key']} }}
                    @break
                    @default
                    <h3>字段元素配置错误: {{ $row['key'] }} !</h3>
                @endswitch
            @endforeach
        </div>

        <div class="box-footer">
            <button type="button" class="btn btn-flat btn-default" onclick="javascript:history.go(-1);">返回</button>

            <button type="submit" class="btn btn-flat btn-primary" id="update_event">提交</button>
        </div>
    </form>
</div>