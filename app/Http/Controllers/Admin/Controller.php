<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Route;

/**
 * 控制器基类
 *
 * Class Controller
 * @package App\Http\Controllers\Admin
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // 返回模型
    const RETURN_MODEL = 1;

    // 返回重定向
    const RETURN_REDIRECT = 2;

    // 返回视图
    const RETURN_VIEW = 3;

    // 模块名
    protected $moduleName;

    // 当前操作基础 url (可扩展出新增 / 修改 / 删除的 url)
    protected $baseUrl;

    // 是否有 user_id 且进行授权校验
    protected $authorize;

    // 主要模型
    protected $model;

    // 主要仓库
    protected $repository;

    // 视图渲染数据
    protected $data;

    public function __construct()
    {
        $this->data['menus'] = $this->getMockMenus();
        $this->data['title'] = "{$this->moduleName}";
    }

    /**
     * 视图渲染
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function renderView()
    {
        return view($this->getViewName(), $this->data);
    }

    /**
     * 通用列表页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->data['title'] = "{$this->moduleName}列表";
        $this->data['base_url'] = $this->baseUrl;
        $this->data['filters'] = $this->model->getSearchFields();
//        dd($this->data['filters']);
        $this->data['fields'] = $this->model->getTableFields();
        $this->data['list'] = $this->repository->paginate();
        return $this->renderView();
    }

    /**
     * 通用创建页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function create()
    {
        $this->data['title'] = "{$this->moduleName}创建";
        $this->data['base_url'] = $this->baseUrl;
        $this->data['fields'] = $this->model->getCreateFields();
        return $this->renderView();
    }

    /**
     * 通用详情页面
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        $item = $this->model->findOrFail($id);

        if ($this->authorize) {
            $this->authorize('view', $item);
        }

        $this->data['title'] = "{$this->moduleName}详情";
        $this->data['fields'] = $this->model->getDetailFields();

        // 钩子调用, 为模型扩展更多属性
        if (method_exists($this->model, 'getDetailFieldsHook')) {
            $this->model->getDetailFieldsHook($item);
        }

        $this->data['item'] = $item;

        return $this->renderView();
    }

    /**
     * 通用编辑页面
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        $item = $this->model->findOrFail($id);

        if ($this->authorize) {
            $this->authorize('update', $item);
        }

        $this->data['title'] = "{$this->moduleName}编辑";

        $this->data['base_url'] = $this->baseUrl;

        $this->data['fields'] = $this->model->getUpdateFields();

        // 钩子调用, 为模型扩展更多属性
        if (method_exists($this->model, 'getUpdateFieldsHook')) {
            $this->model->getUpdateFieldsHook($item);
        }

        $this->data['item'] = $item;

        return $this->renderView();
    }

    /**
     * 通用保存创建数据方法 (需要子类调用)
     *
     * @param $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function _store($request, $returnType = self::RETURN_REDIRECT)
    {
        $input = $request->only($this->model->getStoreKeys());

        if ($this->authorize) {
            $input['user_id'] = $this->adminUser()->id;
        }

        $item = $this->model->create($input);

        if ($returnType === self::RETURN_MODEL) {
            return $item;
        } elseif ($returnType === self::RETURN_REDIRECT) {
            return redirect($this->baseUrl);
        }
    }

    /**
     * 通用保存编辑数据方法 (需要子类调用)
     *
     * @param $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function _update($request, $id, $returnType = self::RETURN_REDIRECT)
    {
        $item = $this->model->findOrFail($id);

        if ($this->authorize) {
            $this->authorize('update', $item);
        }

        $item->update($request->only($this->model->getUpdateKeys()));

        if ($returnType === self::RETURN_MODEL) {
            return $item;
        } elseif ($returnType === self::RETURN_REDIRECT) {
            return redirect($this->baseUrl);
        }
    }

    /**
     * 通用删除数据方法 (需要子类调用)
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function _destroy($id, $returnType = self::RETURN_REDIRECT)
    {
        $item = $this->model->findOrFail($id);

        if ($this->authorize) {
            $this->authorize('delete', $item);
        }

        $item->delete($id);

        if ($returnType === self::RETURN_MODEL) {
            return $item;
        } elseif ($returnType === self::RETURN_REDIRECT) {
            return redirect($this->baseUrl);
        }
    }

    /**
     * 模板名 = 路由别名
     */
    protected function getViewName()
    {
        return Route::currentRouteName();
    }

    protected function adminUser()
    {
        return Auth::user();
    }

    /**
     * 权限
     *
     * @return array
     */
    protected function permissions()
    {
        return [
            'create' => true,
            'show'   => true,
            'edit'   => true,
            'delete' => true,
        ];
    }

    /**
     * 模拟左侧菜单数据
     *
     * @return array
     */
    protected function getMockMenus()
    {
        return [
            [
                'id' => 1,
                'parent_id' => 0,
                'alias' => 'admin.blog',
                'name' => '博客管理',
                'icon' => 'fa-file-text-o',
                'url' => '',
                'sort' => 0,
                'childrens' => [
                    [
                        'id' => 2,
                        'parent_id' => 1,
                        'alias' => 'admin.blog.article',
                        'name' => '文章管理',
                        'icon' => 'fa-edit',
                        'url' => '/admin/article',
                        'sort' => 0,
                    ],
                    [
                        'id' => 3,
                        'parent_id' => 1,
                        'alias' => 'admin.blog.category',
                        'name' => '分类管理',
                        'icon' => 'fa-list-alt',
                        'url' => '/admin/category',
                        'sort' => 0,
                    ],
                    [
                        'id' => 4,
                        'parent_id' => 1,
                        'alias' => 'admin.blog.tag',
                        'icon' => 'fa-tags',
                        'name' => '标签管理',
                        'url' => '/admin/tag',
                        'sort' => 0,
                    ],
                ],
            ],
            [
                'id' => 5,
                'parent_id' => 0,
                'alias' => 'admin.system',
                'name' => '系统设置',
                'icon' => 'fa-terminal',
                'url' => '',
                'sort' => 0,
                'childrens' => [
                    [
                        'id' => 6,
                        'parent_id' => 5,
                        'alias' => 'admin.system.user',
                        'name' => '用户管理',
                        'icon' => 'fa-user',
                        'url' => '/admin/user',
                        'sort' => 0,
                    ],
                    [
                        'id' => 7,
                        'parent_id' => 5,
                        'alias' => 'admin.system.role',
                        'name' => '角色管理',
                        'icon' => 'fa-users',
                        'url' => '/admin/role',
                        'sort' => 0,
                    ],
                    [
                        'id' => 8,
                        'parent_id' => 5,
                        'alias' => 'admin.system.menu',
                        'name' => '菜单权限',
                        'icon' => 'fa-th-large',
                        'url' => '/admin/menu',
                        'sort' => 0,
                    ],
                ],
            ],
        ];
    }
}
