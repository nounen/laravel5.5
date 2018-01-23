<?php

namespace App\Http\Requests\Admin;

use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TagPost extends FormRequest
{
    /**
     * 判断用户是否有权限做出此请求。
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO: 待研究. 以下代码来自手册, 暂时注释
        // $comment = Comment::find($this->route('comment'));
        // return $comment && $this->user()->can('update', $comment);

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
        $rules = Tag::getRequestRules();

        // TODO: sRule::unique('tags')->ignore($id)
        // 思路: 可以把 id 放在 hidden, 作为辅助参数传上来
        if (isUpdateMethod($request->getMethod())) {
            dd($rules);
        }
        // $rules['more'] = 'required';

        return $rules;
    }

    public function attributes()
    {
        $attributes = Tag::getRequestAttributes();

        // $attributes['more'] = '更多';

        return $attributes;
    }
}
