{{-- input 标签 --}}
<div class="form-group">
    <label for="{{ $key }}"
           class="col-sm-2 table_title_width control-label">
        {{ $name }}:
    </label>

    <div class="col-sm-10">
        <input id="{{ $key }}"
               name="{{ $key }}"
               value="{{ $value }}"
               class="form-control"
                {!! $attribute !!}>
    </div>
</div>
