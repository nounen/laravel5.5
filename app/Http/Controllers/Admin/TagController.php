<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\TagPost;

class TagController extends AdminBaseController
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
        $this->data['table_name'] = '标签列表';

        $this->data['page_title'] = '标签列表';

        $this->data['create_url'] = url('admin/tag/create');

        $this->data['table_rows'] = [
            [
                'key' => 'id',
                'val' => 'id',
            ],
            [
                'key' => 'name',
                'val' => '标签名',
            ],
            [
                'key' => 'created_at',
                'val' => '创建时间',
            ],
            [
                'key' => 'updated_at',
                'val' => '修改时间',
            ],
        ];

//        $this->data['table_more']['delete'] = false;

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
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
