{{-- show- 开头的组件，仅仅显示用（不存数据） --}}
<div class="form-group">
    <label for="{{ $key }}"
           class="col-sm-2 table_title_width control-label">
        {{ $field['name'] }}:
    </label>

    <div class="col-sm-10">
        <img class="img-responsive"
             src="{{ $value }}"
             style="max-width: 500px">
    </div>
</div>
