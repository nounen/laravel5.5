<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Repositories\Admin\TagRepository;
use App\Http\Requests\Admin\TagRequest;

class TagController extends Controller
{
    protected $model;

    protected $repository;

    /**
     * 第一个参数是主要模型, 第二个参数是主要仓库
     *
     * TagController constructor.
     * @param TagRepository $repository
     * @param Tag $model
     */
    public function __construct(Tag $model, TagRepository $repository)
    {
        parent::__construct();

        $this->data['module_name'] = '标签';

        $this->data['base_url'] = url('admin/tag');

        $this->model = $model;

        $this->repository = $repository;
    }

    /**
     * 通用保存创建数据方法
     *
     * @param \App\Http\Requests\Admin\TagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        $input = $request->only(Tag::getStoreKeys());

        $input['user_id'] = $this->auth->id;

        $this->model->create($input);

        return redirect($this->data['base_url']);
    }

    /**
     * 通用保存编辑数据方法
     *
     * @param TagRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(TagRequest $request, $id)
    {
        $tag = $this->model->findOrFail($id);

        $this->authorize('update', $tag);

        $tag->update($request->only($this->model->getUpdateKeys()));

        return redirect($this->data['base_url']);
    }

    /**
     * 通用删除方法
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $tag = $this->model->findOrFail($id);

        $this->authorize('delete', $tag);

        $tag->delete($id);

        return redirect($this->data['base_url']);
    }
}
