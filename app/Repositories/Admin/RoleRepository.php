<?php

namespace App\Repositories\Admin;

use App\Models\Role;

/**
 * Class RoleRepository
 * @package App\Repositories
 */
class RoleRepository extends BaseRepository
{
    /**
     * 角色文章
     * @param $request
     */
    public function store($request)
    {
        $article = Role::create(
            $request->only(Role::getStoreKeys())
        );

        $article->permissions()->sync($request->get('permission_ids'));
    }

    /**
     * 分页数据
     */
    public function paginate()
    {
        $fieldMaps = [
            'name' => 'name',
            'role_type' => 'role_type',
            'description' => 'description',
        ];

        $roles = search(Role::class, $fieldMaps)
            ->orderBy('created_at', 'DESC')
            ->paginate(3);

        return $roles;
    }
}
