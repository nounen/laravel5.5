<div class="row">
    <div class="col-xs-12">
        <div class="box" style="border-top: 1px solid #d2d6de;">
            <div class="box-header" style="padding-top: 5px; padding-bottom: 0px;">
                <p>
                    <a href="{{ $base_url }}/create">
                        <button type="button" class="btn btn-sm btn-flat btn-primary">创建</button>
                    </a>
                </p>

                {{--TODO:需要扩展更多搜索--}}
                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                    </div>
                </div>
            </div>

            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-bordered text-center">
                    <tbody>
                        {{-- 表头 --}}
                        <tr>
                            @foreach($fields as $field)
                            <th>{{ getFieldName($field) }}</th>
                            @endforeach

                            <th>操作</th>
                        </tr>

                        {{-- 表格数据 --}}
                        @foreach($list as $item)
                        <tr>
                            @foreach($fields as $key => $field)
                            <td>
                                @if(is_array($field))
                                    {{-- slot 扩展: 一定要实现扩展，否则报错 slot_key_xx 变量未定义 --}}
                                    {{ ${"slot_{$key}_{$item->id}"} }}
                                @else
                                    {{ $item->{$key} }}
                                @endif
                            </td>
                            @endforeach

                            <td>
                                <a href="{{ $base_url }}/{{ $item->id }}">
                                    <button type="button"
                                            class="btn btn-flat btn-xs btn-info">
                                        查看
                                    </button>
                                </a>

                                <a href="{{ $base_url }}/{{ $item->id }}/edit">
                                    <button type="button"
                                            class="btn btn-flat btn-xs btn-warning">
                                        编辑
                                    </button>
                                </a>

                                <button
                                        type="button"
                                        class="btn btn-flat btn-xs btn-danger"
                                        data-toggle="modal"
                                        data-target="#delete_modal_{{ $item->id }}">
                                    删除
                                </button>

                                @include('admin.common.delete', ['id' => $item->id, 'url' => "{$base_url}/{$item->id}"])
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{--TODO: 分页样式应该重写--}}
            <div class="box-footer clearfix" style="padding-top: 0px; padding-bottom: 0px;">
                {{-- 如果没有分页数据就不会显示 --}}
                {{ $list->links() }}
            </div>
        </div>
    </div>
</div>
