<?php

namespace App\Http\Requests\Admin;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
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
        $rules = Role::getRequestRules();

        // 更新时不包含自己
        if (isUpdateAction($request)) {
            $rules['title'][] = Rule::unique('role')->ignore($request->id);
        } else {
            $rules['title'][] = Rule::unique('role');
        }

        return $rules;
    }

    public function attributes()
    {
        $attributes = Role::getRequestAttributes();

        return $attributes;
    }
}
