<?php

/**
 * 表单验证中文语言包, 用多少翻译多少
 */

return [
    'required'             => ':attribute 必填.',

    'unique'               => ':attribute 已经存在.',

    'max'                  => [
        'numeric' => ':attribute 不能大于 :max.',
        'file'    => ':attribute 不能超过 :max 字节.',
        'string'  => ':attribute 不能超过 :max 个字.',
        'array'   => ':attribute 不能超过 :max 个.',
    ],
];