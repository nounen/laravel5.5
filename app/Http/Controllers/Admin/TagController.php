<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Repositories\TagRepository;
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

        $this->data['table_list'] = $this->tagRepository->paginate($this->auth);

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

        $this->tagRepository->store($input);

        return redirect($this->data['base_url']);
    }

    /**
     * Display the specified resource.
     *
     * TODO: 备注
     * public function show($id) // 自己想在仓库做更多业务使用这样
     *
     * public function show(Tag $tag) // 简单模型查询使用这个
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data['title'] = '标签详情';

        $this->data['item_rows'] = Tag::getDetailRows();

        $tag = Tag::findOrFail($id);

        // 策略处理方式 1
//        if ($this->auth->cant('view', $tag)) {
//            dd('策略处理方式 1!');
//        }

        // 策略处理方式 2
        $this->authorize('view', $tag);

        $this->data['item'] = $this->tagRepository->show($id, $this->auth);

        return view('admin.tag.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['title'] = '编辑标签';

        $this->data['update_rows'] = Tag::getUpdateRows();

        $this->data['item'] = $this->tagRepository->show($id, $this->auth);

        return view('admin.tag.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Admin\TagPost  $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagPost $request, $id)
    {
        $input = $request->only(Tag::getUpdateKeys());

        $this->tagRepository->update($id, $input, $this->auth);

        return redirect($this->data['base_url']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->tagRepository->destroy($id, $this->auth);

        return redirect($this->data['base_url']);
    }
}
