<div class="form-group">
    <label for="{{ $key }}"
           class="col-sm-2 table_title_width control-label">
        {{ $name }}:
    </label>

    <div class="col-sm-10">
        <input name="{{ $key }}"
               type="file"
               accept="image/*"
               onchange="loadFile(event, 'input-image-{{ $key }}')"
               style="margin-bottom: 15px;">

        <img id="input-image-{{ $key }}"
             src="{{ getAssetUrl($value) }}"
             class="img-responsive"/>
    </div>
</div>

<script>
// 图片预览
var loadFile = function(event, id) {
    var output = document.getElementById(id);
    output.src = URL.createObjectURL(event.target.files[0]);
};
</script>
