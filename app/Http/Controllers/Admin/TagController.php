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
     * @param TagRepository $tagRepository
     * @param Tag $tag
     */
    public function __construct(Tag $tag, TagRepository $tagRepository)
    {
        parent::__construct();

        $this->moduleName = '标签';

        $this->baseUrl = url('admin/tag');

        $this->authorize = true;

        $this->model = $tag;

        $this->repository = $tagRepository;
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
