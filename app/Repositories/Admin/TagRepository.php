<?php

namespace App\Repositories\Admin;

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
    public function paginate()
    {
        $fieldMaps = [];

        $tags = search(Tag::class, $fieldMaps)
                    ->ofUser()
                    ->orderBy('sort')
                    ->orderBy('created_at', 'DESC')
                    ->paginate();

        return $tags;
    }
}