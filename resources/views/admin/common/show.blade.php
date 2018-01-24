<div class="row">
    <div class="col-xs-12">
        <div class="box" style="border-top: 1px solid #d2d6de;">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-bordered text-center">
                    <tbody>
                    @foreach($item_rows as $key => $name)
                        <tr>
                        @if(is_array($name))
                            {{-- slot 扩展 --}}
                            <th>{{ $name['name'] }}:</th>
                            <td>{{ ${$key.$item->id} }}<td>
                        @else
                            <th>{{ $name }}:</th>
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