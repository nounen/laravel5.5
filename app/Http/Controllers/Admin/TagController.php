<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Repositories\Admin\TagRepository;
use App\Http\Requests\Admin\TagPost;

class TagController extends Controller
{
    protected $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        parent::__construct();

        $this->data['base_url'] = url('admin/tag');

        $this->tagRepository = $tagRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title'] = '标签列表';

        $this->data['table_permissions'] = $this->permissions();

        $this->data['table_rows'] = Tag::getTableRows();

        $this->data['table_list'] = $this->tagRepository->paginate();

        return view('admin.tag.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['title'] = '创建标签';

        $this->data['create_rows'] = Tag::getCreateRows();

        return view('admin.tag.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Admin\TagPost  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagPost $request)
    {
        $input = $request->only(Tag::getStoreKeys());

        $input['user_id'] = $this->auth->id;

        Tag::create($input);

        return redirect($this->data['base_url']);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);

        $this->authorize('view', $tag);

        $this->data['title'] = '标签详情';

        $this->data['item_rows'] = Tag::getDetailRows();

        $this->data['item'] = $tag;

        return view('admin.tag.show', $this->data);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);

        $this->authorize('update', $tag);

        $this->data['title'] = '编辑标签';

        $this->data['update_rows'] = Tag::getUpdateRows();

        $this->data['item'] = $tag;

        return view('admin.tag.edit', $this->data);
    }

    /**
     * @param TagPost $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(TagPost $request, $id)
    {
        $tag = Tag::findOrFail($id);

        $this->authorize('update', $tag);

        $tag->update($request->only(Tag::getUpdateKeys()));

        return redirect($this->data['base_url']);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);

        $this->authorize('delete', $tag);

        $tag->delete($id);

        return redirect($this->data['base_url']);
    }
}
