{{--
    模态框确认删除操作

    使用方式:

    @include('layouts.common_delete_modal', ['id' => $item->id, 'url' => "{$base_url}/{$item->id}"])

    <button type="button" class="btn btn-flat btn-xs btn-danger" data-toggle="modal" data-target="#delete_modal_{{ $item->id }}">
        删除
    </button>
--}}
<div class="modal modal-danger fade" id="delete_modal_{{ $id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <h4 class="modal-title">危险操作</h4>
            </div>
            <div class="modal-body text-center">
                <p>删除后数据不可恢复!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-flat btn-outline pull-left" data-dismiss="modal">取消</button>

                <form action="{{ $url }}" method="POST" style="display: inline;">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-flat btn-danger btn-outline">删除</button>
                </form>
            </div>
        </div>
    </div>
</div>