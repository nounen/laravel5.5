<?php

namespace App\Models;

/**
 * Class Tag
 * @package App\Models
 */
class Tag extends BaseModel
{
    protected $table = 'tag';

    protected $fillable = [
        'name',
        'sort',
        'user_id',
    ];

    /**
     * 所有字段
     *
     * @return array
     */
    public static function getFields()
    {
        return [
            'id' => [
                'name'   => '主键',
                'table'  => true,
                'detail' => true,
                'update' => true,
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'hidden',
                    'disabled' => 'disabled',
                ],
            ],
            'name' => [
                'name'   => '标签名',
                'table'  => 'slot',
                'detail' => 'slot',
                'create' => true,
                'update' => true,
                'rule'   => 'required|unique:tag|max:5',
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'text',
                    'required' => 'required',
                ],
            ],
            'sort' => [
                'name'   => '排序',
                'table'  => true,
                'detail' => true,
                'create' => true,
                'update' => true,
                'rule'   => 'required|numeric',
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'number',
                    'required' => 'required',
                ],
            ],
            'article_count' => [
                'name'   => '关联文章数',
                'table'  => true,
                'detail' => true,
                'update' => true,
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'number',
                    'disabled' => 'disabled',
                ],
            ],
            'user_id' => [
                'name'   => '创建人',
                'table'  => true,
                'detail' => true,
            ],
            'created_at' => [
                'name'   => '创建时间',
                'table'  => true,
                'detail' => true,
                'update' => true,
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'text',
                    'disabled' => 'disabled',
                ],
            ],
            'updated_at' => [
                'name'   => '更新时间',
                'table'  => true,
                'detail' => true,
                'update' => true,
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'text',
                    'disabled' => 'disabled',
                ],
            ],

        ];
    }
}
