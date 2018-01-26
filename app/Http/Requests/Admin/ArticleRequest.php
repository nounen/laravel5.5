<?php

namespace App\Http\Requests\Admin;

use App\Models\Article;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ArticleRequest extends FormRequest
{
    /**
     * 判断用户是否有权限做出此请求。
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        // 更多规则可以自己添加
        $rules = Article::getRequestRules();

        return $rules;
    }

    public function attributes()
    {
        $attributes = Article::getRequestAttributes();

        // $attributes['more'] = '更多';

        return $attributes;
    }
}
