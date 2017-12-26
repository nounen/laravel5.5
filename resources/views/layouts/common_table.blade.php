<div class="row">
    <div class="col-xs-12">
        <div class="box" style="border-top: 1px solid #d2d6de;">
            <div class="box-header" style="padding-top: 5px; padding-bottom: 0px;">
                {{--<h3 class="box-title"><span>{{ $table_name}}</span></h3>--}}

                @if($table_more['create'])
                <p>
                    <a href="{{ $create_url }}">
                        <button type="button" class="btn btn-sm btn-flat btn-primary">创建</button>
                    </a>
                </p>
                @endif

                {{--TODO:需要扩展更多搜索--}}
                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                    </div>
                </div>
            </div>

            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-bordered text-center">
                    <tbody>
                        <tr>
                            @foreach($table_rows as $row)
                            <th>{{ $row['val'] }}</th>
                            @endforeach

                            <th>操作</th>
                        </tr>

                        @foreach($table_lists as $item)
                        <tr>
                            @foreach($table_rows as $row)
                            <td>{{ $item->{$row['key']} }}</td>
                            @endforeach

                            <td>
                                @if($table_more['show'])<button type="button" class="btn btn-flat btn-xs btn-info">查看</button> @endif
                                @if($table_more['edit'])<button type="button" class="btn btn-flat btn-xs btn-warning">编辑</button> @endif
                                @if($table_more['delete'])<button type="button" class="btn btn-flat btn-xs btn-danger">删除</button> @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->

            {{--TODO: 分页样式应该重写--}}
            <div class="box-footer clearfix" style="padding-top: 0px; padding-bottom: 0px;">
                {{-- 如果没有分页数据就不会显示 --}}
                {{ $table_lists->links() }}
            </div>
        </div>
        <!-- /.box -->
    </div>
</div>