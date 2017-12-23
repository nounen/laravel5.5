<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Routing\Router AS Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/adminlte', function () {
    $menus = [
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

    $data['menus'] = $menus;

    return view('adminlte', $data);
});