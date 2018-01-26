<?php

namespace App\Repositories\Admin;

use App\Models\Category;

/**
 * Class CategoryRepository
 * @package App\Repositories
 */
class CategoryRepository extends BaseRepository
{
    /**
     * 分页数据
     */
    public function paginate()
    {
        $fieldMaps = [];

        $tags = search(Category::class, $fieldMaps)
                    ->ofUser()
                    ->orderBy('sort')
                    ->orderBy('created_at', 'DESC')
                    ->paginate();

        return $tags;
    }
}