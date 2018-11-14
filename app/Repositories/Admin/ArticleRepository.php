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

        $articles = search(Article::class, $fieldMaps)
                    ->with('user')
                    ->ofUser()
                    ->orderBy('created_at', 'DESC')
                    ->paginate();

        return $articles;
    }
}