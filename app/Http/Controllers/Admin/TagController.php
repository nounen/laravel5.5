<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Repositories\Admin\TagRepository;
use App\Http\Requests\Admin\TagRequest;

class TagController extends Controller
{
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

        $this->authorize = true;

        $this->model = $model;

        $this->repository = $repository;
    }

    /**
     * @param TagRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TagRequest $request)
    {
        return parent::_store($request);
    }

    /**
     * @param TagRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(TagRequest $request, $id)
    {
        return parent::_update($request, $id);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        return parent::_destroy($id);
    }
}
