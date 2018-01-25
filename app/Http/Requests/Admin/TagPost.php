<?php

namespace App\Http\Requests\Admin;

use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

        // 更新时不包含自己
        if (isUpdateMethod($request->getMethod()) && $request->id) {
            $rules['name'][] = Rule::unique('tag')->ignore($request->id);
        } else {
            $rules['name'][] = 'unique:tag';
        }

        return $rules;
    }

    public function attributes()
    {
        $attributes = Tag::getRequestAttributes();

        // $attributes['more'] = '更多';

        return $attributes;
    }
}
