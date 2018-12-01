<div class="form-group">
    <label for="{{ $key }}"
           class="col-sm-2 table_title_width control-label">
        {{ $name }}:
    </label>

    <div class="checkbox col-sm-10" id="{{ $key }}">
        @foreach($options() as $option)
        <label>
            <input name="{{ $key }}[]"
                   value="{{ $option['value'] }}"
                    {{-- 如果 value 是数组 --}}
                    @if(is_array($value))
                        @foreach($value as $val)
                        {!! getCheckedResult($option['value'], $val) !!}
                        @endforeach
                    @else
                        {!! getCheckedResult($option['value'], $val) !!}
                    @endif
                    {!! $attribute !!} >
            {{ $option['name'] }}
        </label>
        @endforeach
    </div>
</div>
