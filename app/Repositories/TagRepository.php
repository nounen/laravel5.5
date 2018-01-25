<?php

namespace App\Repositories;

use App\Models\Tag;

/**
 * Class TagRepository
 * @package App\Repositories
 */
class TagRepository extends BaseRepository
{
    /**
     * 分页数据
     */
    public function paginate($user)
    {
        $fieldMaps = [];

        $tags = search(Tag::class, $fieldMaps)
                    ->where('user_id', $user->id)
                    ->orderBy('sort')
                    ->orderBy('created_at', 'DESC')
                    ->paginate();

        return $tags;
    }
}