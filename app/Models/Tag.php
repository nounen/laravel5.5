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
            [
                'key'    => 'id',
                'name'   => 'id',
                'table'  => true,
                'create' => false,
                'update' => true,
                'detail' => true,
            ],
            [
                'key'    => 'name',
                'name'   => '标签名',
                'table'  => true,
                'create' => [
                    'type' => 'text',

                ],
                'update' => true,
                'detail' => true,
                'rule'   => 'required|unique:tag|max:5',
            ],
            [
                'key'    => 'sort',
                'name'   => '排序',
                'table'  => true,
                'create' => [
                    'type' => 'number',
                ],
                'update' => true,
                'detail' => true,
                'rule'   => 'required|numeric',
            ],
            [
                'key'    => 'article_count',
                'name'   => '关联文章数',
                'table'  => true,
                'create' => false,
                'update' => true,
                'detail' => true,
            ],
            [
                'key'    => 'user_id',
                'name'   => '创建人',
                'table'  => true,
                'create' => false,
                'update' => true,
                'detail' => true,
            ],
            [
                'key'    => 'created_at',
                'name'   => '创建时间',
                'table'  => true,
                'create' => false,
                'update' => true,
                'detail' => true,
            ],
            [
                'key'    => 'updated_at',
                'name'   => '更新时间',
                'table'  => true,
                'create' => false,
                'update' => true,
                'detail' => true,
            ],
        ];
    }
}
