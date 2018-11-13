<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

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
                'update' => true,
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'hidden',
                ],
            ],
            'name' => [
                'name'   => '标签名',
                'slots'  => [
                    'table' => true,
                ],
                'detail' => 'slot',
                'create' => true,
                'update' => true,
                'rule'   => [
                    'required',
                    'max:10'
                ],
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'text',
                    'required' => 'required',
                ],
            ],
            'sort' => [
                'name'   => '排序',
                'create' => true,
                'update' => true,
                'rule'   => [
                    'required',
                    'numeric',
                ],
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'number',
                    'required' => 'required',
                ],
            ],
            'created_at' => [
                'name'   => '创建时间',
                'update' => true,
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'text',
                    'disabled' => 'disabled',
                ],
            ],
            'updated_at' => [
                'name'   => '更新时间',
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
     * 列表字段
     * @return array
     */
    public static function tableKeys()
    {
        return [
            'id',
            'name',
            'sort',
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
            'name',
            'sort',
            'created_at',
            'updated_at',
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
     * 根据文章获取标签 id
     *
     * @param $articleId
     * @return mixed
     */
    public static function getTagIds($articleId)
    {
        return DB::table('article_tag')
            ->where('article_id', $articleId)
            ->pluck('tag_id')
            ->toArray();
    }
}
