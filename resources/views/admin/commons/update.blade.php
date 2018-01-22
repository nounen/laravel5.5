<div class="box" style="border-top: 1px solid #d2d6de;">
    <form role="form" method="POST" action="{{ $base_url }}/{{ $item->id }}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="box-body">
            @foreach($update_rows as $row)
                <div class="form-group">
                    <label for="{{ $row['key'] }}">{{ $row['name'] }}</label>

                    <input id="{{ $row['key'] }}"
                           name="{{ $row['key'] }}"
                           value="{{ $item->{$row['key']} }}"
                           type="{{ $row['attr']['type'] }}"
                           placeholder="{{ $row['name'] }}"
                           class="form-control">
                </div>
            @endforeach
        </div>

        <div class="box-footer">
            <button type="button" class="btn btn-flat btn-default" onclick="javascript:history.go(-1);">返回</button>
            <button type="submit" class="btn btn-flat btn-primary">提交</button>
        </div>
    </form>
</div>