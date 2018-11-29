<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Repositories\Admin\UserRepository;
use App\Http\Requests\Admin\UserRequest;

class UserController extends Controller
{
    /**
     * 第一个参数是主要模型, 第二个参数是主要仓库
     *
     * UserController constructor.
     * @param UserRepository $userRepository
     * @param User $user
     */
    public function __construct(User $user, UserRepository $userRepository)
    {
        parent::__construct();

        $this->authorize = false;
        $this->setTitle('用户');
        $this->setBaseUrl(url('admin/user'));
        $this->setViewDir('admin.user');

        $this->model = $user;
        $this->repository = $userRepository;
    }

    /**
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(UserRequest $request)
    {
        $this->repository->store($request->all());

        return redirect($this->data['base_url']);
    }

    /**
     * @param UserRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UserRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);

        return redirect($this->data['base_url']);
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
