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

    protected $data;

    protected $auth;

    protected $calledClass;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->auth = Auth::user();

            return $next($request);
        });

        $this->data['menus'] = $this->getMockMenus();

        // 模块名
        $this->data['module_name'] = 'XX 模块';

        // 当前操作名
        $this->data['title'] = "{$this->data['module_name']} 的 xx 操作";

        // 当前操作基础 url (可扩展出新增 / 修改 / 删除的 url)
        $this->data['base_url'] = url('xx/xx');
    }

    /**
     * 通用列表页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->data['title'] = "{$this->data['module_name']}列表";

        $this->data['table_permissions'] = $this->permissions();

        $this->data['table_rows'] = $this->model->getTableRows();

        $this->data['table_list'] = $this->repository->paginate();

        return view($this->getViewName(), $this->data);
    }

    /**
     * 通用创建页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->data['title'] = "{$this->data['module_name']}创建";

        $this->data['create_rows'] = $this->model->getCreateRows();

        return view($this->getViewName(), $this->data);
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

        $this->authorize('view', $item);

        $this->data['title'] = "{$this->data['module_name']}详情";

        $this->data['item_rows'] = $this->model->getDetailRows();

        $this->data['item'] = $item;

        return view($this->getViewName(), $this->data);
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

        $this->authorize('update', $item);

        $this->data['title'] = "{$this->data['module_name']}标签";

        $this->data['update_rows'] = $this->model->getUpdateRows();

        $this->data['item'] = $item;

        return view($this->getViewName(), $this->data);
    }

    /**
     * 模板名 = 路由别名
     */
    protected function getViewName()
    {
        return Route::currentRouteName();
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
