<div class="form-group">
    <label for="{{ $key }}"
           class="col-sm-2 table_title_width control-label">
        {{ $name }}:
    </label>

    <div class="col-sm-10">
        <textarea id="{{ $key }}"
                  name="{{ $key }}"
                  class="form-control"
                {!! $attribute !!}>{{ $value }}</textarea>
    </div>
</div>

<script>
// textarea 高度自适应
$.each($("textarea"), function(i, n){
    // 为什么 + 5: 因为高度还是差一点, 导致出现滚轴
    $(n).css("height", (n.scrollHeight + 5) + "px");
})
</script>
