<div class="row">
    <div class="col-xs-12">
        <div class="box" style="border-top: 1px solid #d2d6de;">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-bordered text-center">
                    <tbody>
                    @foreach($item_rows as $row)
                        <tr>
                            <th>{{ $row['name'] }}:</th>
                            <td>{{ $item->{$row['key']} }}</td>
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