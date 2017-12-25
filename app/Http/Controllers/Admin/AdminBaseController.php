<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdminBaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $data;

    protected $auth;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->auth = Auth::user();

            return $next($request);
        });

        $this->data['menus'] = $this->getMockMenus();

        $this->data['table_more'] = $this->getDefaultTableMore();
    }

    /**
     * table 列表更多操作
     *
     * @return array
     */
    protected function getDefaultTableMore()
    {
        return [
            'create' => true,
            'show' => true,
            'edit' => true,
            'delete' => true,
        ];
    }

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
