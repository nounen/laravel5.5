<div class="form-group">
    <label for="{{ $key }}"
           class="col-sm-2 table_title_width control-label">
        {{ $name }}:
    </label>

    <div class="col-sm-10">
        <div id="wang-editor-{{ $key }}"></div>
    </div>

    <textarea id="wang-editor-textarea-{{ $key }}"
              name="{{ $key }}"
              class="hidden">{!! $value !!}</textarea>
</div>

<script type="text/javascript">
// wangEditor 编辑器初始化
var E = window.wangEditor;
var editor{{ $key }} = new E('#wang-editor-{{ $key }}');
var textarea{{ $key }} = $("#wang-editor-textarea-{{ $key }}");

// wangEditor 内容变化监测，同步更新到 textarea
editor{{ $key }}.customConfig.onchange = function (html) {
    textarea{{ $key }}.html(html);
}

// 初始化
editor{{ $key }}.customConfig.uploadImgShowBase64 = true
editor{{ $key }}.create();
editor{{ $key }}.txt.html(`{!! $value !!}`);
textarea{{ $key }}.html(editor{{ $key }}.txt.html())

// 详情页高度特殊设置
@if(isset($from) && $from == 'show') {
    $('.w-e-text-container').height("auto");
}
@endif
</script>
