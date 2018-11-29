<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        // 更多规则可以自己添加
        $rules = User::getRequestRules();

        // 更新时不包含自己
        if (isUpdateAction($request)) {
            $rules['name'][] = Rule::unique('user')->ignore($request->id);
        } else {
            $rules['name'][] = Rule::unique('user');
        }

        return $rules;
    }

    public function attributes()
    {
        $attributes = User::getRequestAttributes();

        return $attributes;
    }
}
