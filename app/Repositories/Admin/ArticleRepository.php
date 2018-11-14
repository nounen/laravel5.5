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
     * 创建文章
     * @param $request
     * @param $article
     */
    public function store($request, $article)
    {
        $input = $request->only($article->getStoreKeys());
        $input['user_id'] = $this->adminUser()->id;
        $input['cover'] = saveFile($request->file('cover'), 'covers');
        $article->create($input);
    }

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