<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Tree;
use App\Models\Permission;
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

    protected $baseUrl;

    // 是否有 user_id 且进行授权校验
    protected $authorize = true;

    // 主要模型
    protected $model;

    // 主要仓库
    protected $repository;

    // 模板目录
    protected $viewDir;

    // 模板文件名
    protected $viewFile;

    // 模板文件全名
    protected $viewDirFile;

    // 视图渲染数据
    protected $data = [
        'title' => '',
        'base_url' => '',
        'filters' => [],
        'fields' => [],
        'list' => [],
        'item' => [],
        'menus' => [],
    ];

    public function __construct()
    {
        $this->data['menus'] = $this->getMockMenus();
    }

    // <title></title> 设置
    protected function setTitle($title)
    {
        $this->data['title'] = $title;
    }

    // 模块所属 url
    protected function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
        $this->data['base_url'] = $baseUrl;
    }

    // 视图模板目录
    protected function setViewDir($dir)
    {
        $this->viewDir = $dir;
    }

    // 视图模板名字
    protected function setViewName($name)
    {
        $this->viewFile = $name;
    }

    /**
     * 视图渲染
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function renderView($viewName = '')
    {
        if (empty($viewName)) {
            $viewName = $this->getViewDirName();
        }

        return view($viewName, $this->data);
    }

    /**
     * 通用列表页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->data['title'] = "{$this->data['title']}列表";
        $this->data['filters'] = $this->model->searchFields();
        $this->data['fields'] = $this->model->getIndexFields();
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
        $this->data['title'] = "{$this->data['title']}创建";
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

        $this->data['title'] = "{$this->data['title']}详情";
        $this->data['fields'] = $this->model->getShowFields();

        // 钩子调用, 为模型扩展更多属性
        if (method_exists($this->model, 'getShowFieldsHook')) {
            $this->model->getShowFieldsHook($item);
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

        $this->data['title'] = "{$this->data['title']}编辑";
        $this->data['fields'] = $this->model->getEditFields();

        // 钩子调用, 为模型扩展更多属性
        if (method_exists($this->model, 'getEditFieldsHook')) {
            $this->model->getEditFieldsHook($item);
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
            return redirect($this->data['base_url']);
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
            return redirect($this->data['base_url']);
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
    protected function getViewDirName()
    {
        if (empty($this->viewDirFile)) {
            $expName = explode('@', Route::getCurrentRoute()->getActionName());
            $this->viewFile = end($expName);
            $this->viewDirFile = "{$this->viewDir}.$this->viewFile";
        }

        return $this->viewDirFile;
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
        $permissions = Permission::all()->toArray();
        $menus = Tree::makeTree($permissions);
        return $menus;
    }
}
