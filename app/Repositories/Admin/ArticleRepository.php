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
     */
    public function store($request)
    {
        $input = $request->only(Article::getStoreKeys());
        $input['user_id'] = $this->adminUser()->id;
        $input['cover'] = saveFile($request->file('cover'), 'covers');

        $article = Article::create($input);
        $article->tags()->sync($request->get('tag_ids'));
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