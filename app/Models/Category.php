<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 * Class Category
 * @package App\Models
 */
class Category extends BaseModel
{
    protected $table = 'category';

    protected $fillable = [
        'parent_id',
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
                'detail' => true,
                'update' => true,
                'element'=> 'input',
                'attributes' => [
                    'type' => 'hidden',
                ],
            ],
            'parent_id' => [
                'name'   => '父级主键',
                'detail' => true,
                'update' => true,
                'element'=> 'input',
                'attributes' => [
                    'type' => 'hidden',
                ],
            ],
            'name' => [
                'name'   => '分类名',
                'detail' => true,
                'create' => true,
                'update' => true,
                'rule'   => [
                    'required',
                    'max:10',
                ],
                'element'=> 'input',
                'attributes' => [
                    'type' => 'text',
                    'required' => 'required',
                ],
            ],
            'sort' => [
                'name'   => '排序',
                'detail' => true,
                'create' => true,
                'update' => true,
                'rule'   => [
                    'required',
                    'numeric'
                ],
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'number',
                    'required' => 'required',
                ],
            ],
            'article_count' => [
                'name'   => '关联文章数',
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
                'detail' => true,
            ],
            'created_at' => [
                'name'   => '创建时间',
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

    /**
     * 作为下拉选项
     *
     * @return mixed
     */
    public static function beOptions()
    {
        $fields = [
            'id AS value',
            'name',
        ];

        return self::ofUser()->get($fields);
    }

    /**
     * 列表字段
     * @return array
     */
    public static function tableKeys()
    {
        return [
            'id',
            'parent_id',
            'name',
            'sort',
            'article_count',
            'user_id',
            'created_at',
            'updated_at',
        ];
    }

    /**
     * 详情字段
     * @return array
     */
    public static function detailKeys()
    {
        return [
            'id',
            'parent_id',
            'name',
            'sort',
            'article_count',
            'created_at',
            'updated_at',
        ];
    }
}
