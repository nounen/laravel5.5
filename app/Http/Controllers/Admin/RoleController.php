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

//        $this->authorize = false;
        $this->setTitle('角色');
        $this->setBaseUrl(url('admin/role'));
        $this->setViewDir('admin.role');

        $this->model = $role;
        $this->repository = $roleRepository;
    }

    /**
     * @param TagRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(RoleRequest $request)
    {
        $this->repository->store($request);
        return redirect($this->baseUrl);
    }
}
