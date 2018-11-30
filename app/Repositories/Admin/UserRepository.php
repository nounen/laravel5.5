<?php

namespace App\Repositories\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    public function store($input)
    {
        $input['password'] = Hash::make($input['password']);
        User::create($input);
    }

    /**
     * 分页数据
     */
    public function paginate()
    {
        $fieldMaps = [
        ];

        $list = search(User::class, $fieldMaps)
            ->with([
                'role',
            ])
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return $list;
    }

    public function update($input, $id)
    {
        if (! empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']);
        }
dd($input);
        $user = User::findOrFail($id);
        $user->update($input);
    }
}
