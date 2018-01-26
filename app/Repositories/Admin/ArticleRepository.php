<?php

namespace App\Repositories\Admin;

use App\Models\Article;

/**
 * Class ArticleRepository
 * @package App\Repositories
 */
class ArticleRepository extends BaseRepository
{
    /**
     * 分页数据
     */
    public function paginate()
    {
        $fieldMaps = [];

        $tags = search(Article::class, $fieldMaps)
                    ->ofUser()
                    ->orderBy('sort')
                    ->orderBy('created_at', 'DESC')
                    ->paginate();

        return $tags;
    }
}