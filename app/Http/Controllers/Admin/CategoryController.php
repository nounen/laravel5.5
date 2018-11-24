<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Repositories\Admin\CategoryRepository;
use App\Http\Requests\Admin\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * 第一个参数是主要模型, 第二个参数是主要仓库
     *
     * CategoryController constructor.
     * @param CategoryRepository $categoryRepository
     * @param Category $category
     */
    public function __construct(Category $category, CategoryRepository $categoryRepository)
    {
        parent::__construct();

        $this->setTitle('分类');
        $this->setBaseUrl(url('admin/category'));
        $this->setViewDir('admin.category');

        $this->model = $category;
        $this->repository = $categoryRepository;
    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CategoryRequest $request)
    {
        return parent::_store($request);
    }

    /**
     * @param CategoryRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(CategoryRequest $request, $id)
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
