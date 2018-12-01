<div class="form-group">
    <label for="{{ $key }}"
           class="col-sm-2 table_title_width control-label">
        {{ $name }}:
    </label>

    <div class="col-sm-10">
        <select id="{{ $key }}"
                name="{{ getSelectName($attribute, $key) }}"
                class="form-control"
                {!! $attribute !!}>

            @foreach($options() as $option)
            <option value="{{ $option['value'] }}"
                {{-- 多选 --}}
                @if(is_array($value))
                    @foreach($value as $val)
                    {{ getSelectResult($option['value'], $val) }}
                    @endforeach
                {{-- 单选 --}}
                @else
                    {{ getSelectResult($option['value'], $value) }}
                @endif
                >{{ $option['name'] }}</option>
            @endforeach
        </select>
    </div>
</div>
