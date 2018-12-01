<div class="form-group">
    <label for="{{ $key }}"
           class="col-sm-2 table_title_width control-label">
        {{ $name }}:
    </label>

    <div class="radio col-sm-10" id="{{ $key }}">
        @foreach($options() as $option)
        <label>
            <input name="{{ $key }}"
                   value="{{ $option['value'] }}"
                    {!! getCheckedResult($option['value'], $value) !!}
                    {!! $attribute !!} >
            {{ $option['name'] }}
        </label>
        @endforeach
    </div>
</div>
