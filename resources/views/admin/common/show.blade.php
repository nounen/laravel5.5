<style>
/* 避免内容太多把标题挤没了 */
.table_title_width {
    min-width: 80px;
    max-width: 120px;
}
</style>

<div class="row">
    <div class="col-xs-12">
        <div class="box" style="border-top: 1px solid #d2d6de;">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-bordered">
                    <tbody>
                    @foreach($item_rows as $key => $name)
                        <tr>
                        @if(is_array($name))
                            {{-- slot 扩展 --}}
                            <th class="table_title_width">{{ $name['name'] }}:</th>
                            <td>{{ ${$key.$item->id} }}<td>
                        @else
                            <th class="table_title_width">{{ $name }}:</th>
                            <td>{{ $item->{$key} }}</td>
                        @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="button" class="btn btn-flat btn-default" onclick="javascript:history.go(-1);">返回</button>
            </div>
        </div>
        <!-- /.box -->
    </div>
</div>