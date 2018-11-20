<?php

namespace App\Http\Requests\Admin;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        $rules = Category::getRequestRules();

        // 更新时不包含自己
        if (isUpdateAction($request)) {
            $rules['name'][] = Rule::unique('category')->ignore($request->id);
        } else {
            $rules['name'][] = Rule::unique('category');
        }

        return $rules;
    }

    public function attributes()
    {
        $attributes = Category::getRequestAttributes();

        // $attributes['more'] = '更多';

        return $attributes;
    }
}
