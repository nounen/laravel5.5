<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules()
    {
        return [
            'name' => 'required|unique:tag|max:12',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '标签名',
        ];
    }
}
