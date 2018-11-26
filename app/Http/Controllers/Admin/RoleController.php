<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Repositories\Admin\RoleRepository;
use App\Http\Requests\Admin\RoleRequest;

class RoleController extends Controller
{
    public function __construct(Role $role, RoleRepository $roleRepository)
    {
        parent::__construct();

        $this->authorize = false;
        $this->setTitle('角色');
        $this->setBaseUrl(url('admin/role'));
        $this->setViewDir('admin.role');

        $this->model = $role;
        $this->repository = $roleRepository;
    }

    /**
     * @param RoleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(RoleRequest $request)
    {
        $this->repository->store($request);
        return redirect($this->baseUrl);
    }

    /**
     * @param RoleRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(RoleRequest $request, $id)
    {
        $article = parent::_update($request, $id, self::RETURN_MODEL);

        $article->permissions()->sync($request->get('permissions_ids'));

        return redirect($this->baseUrl);
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
