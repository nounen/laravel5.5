<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BaseModel;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * 任何继承 BaseModel 都可以使用这个 Policy
 *
 * Class BaseModelPolicy
 * @package App\Policies
 */
class BaseModelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the baseModel.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BaseModel  $baseModel
     * @return mixed
     */
    public function view(User $user, BaseModel $baseModel)
    {
        return $user->id === $baseModel->user_id;
    }

    /**
     * Determine whether the user can create baseModels.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the baseModel.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BaseModel  $baseModel
     * @return mixed
     */
    public function update(User $user, BaseModel $baseModel)
    {
        return $user->id === $baseModel->user_id;
    }

    /**
     * Determine whether the user can delete the baseModel.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BaseModel  $baseModel
     * @return mixed
     */
    public function delete(User $user, BaseModel $baseModel)
    {
        return $user->id === $baseModel->user_id;
    }
}
