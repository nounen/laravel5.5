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

        $this->tagRepository = $tagRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['page_title'] = '标签列表';

        $this->data['base_url'] = url('admin/tag');

        $this->data['table_rows'] = Tag::getTableRows();

        $this->data['table_lists'] = $this->tagRepository->paginate($this->auth);

        return view('admin.tag.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['page_title'] = '创建标签';

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
        $input = $request->only([
            'name',
        ]);

        $input['user_id'] = $this->auth->id;

        $this->tagRepository->store($input);

        return redirect(url('admin/tag'));
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
        $this->data['page_title'] = '标签详情';

        $this->data['item_rows'] = Tag::getItemRows();

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
        $this->data['page_title'] = '编辑标签';

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
        $input = $request->only([
            'name',
        ]);

        $this->tagRepository->update($id, $input, $this->auth);

        return redirect(url('admin/tag'));
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

        return redirect(url('admin/tag'));
    }
}
