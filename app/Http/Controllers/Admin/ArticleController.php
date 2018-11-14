<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Repositories\Admin\ArticleRepository;
use App\Http\Requests\Admin\ArticleRequest;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    /**
     * 第一个参数是主要模型, 第二个参数是主要仓库
     *
     * ArticleController constructor.
     * @param ArticleRepository $articleRepository
     * @param Article $article
     */
    public function __construct(Article $article, ArticleRepository $articleRepository)
    {
        parent::__construct();

        $this->moduleName = '文章';
        $this->baseUrl = url('admin/article');
        $this->authorize = true;
        $this->model = $article;
        $this->repository = $articleRepository;
    }

    /**
     * @param ArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ArticleRequest $request)
    {
        $this->repository->store($request, $this->model);
        return redirect($this->baseUrl);
    }

    /**
     * @param ArticleRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(ArticleRequest $request, $id)
    {
        $article = parent::_update($request, $id, self::RETURN_MODEL);

        $article->tags()->sync($request->get('tags_ids'));

        return redirect($this->baseUrl);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        return parent::_destroy($id);
    }
}
