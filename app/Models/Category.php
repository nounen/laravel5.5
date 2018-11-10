<?php

namespace App\Models;

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
                'table'  => true,
                'detail' => true,
                'update' => true,
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'hidden',
                ],
            ],
            'parent_id' => [
                'name'   => '父级主键',
                'table'  => true,
                'detail' => true,
                'update' => true,
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'hidden',
                ],
            ],
            'name' => [
                'name'   => '分类名',
                'table'  => true,
                'detail' => true,
                'create' => true,
                'update' => true,
                'rule'   => ['required', 'max:10'],
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
     * 查询作用域
     *
     * @param $query
     * @return mixed
     */
    public function scopeOfUser($query)
    {
        return $query->where('user_id', self::adminUser()->id);
    }
}
