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
        'user_id',
    ];

    /**
     * 列表通用显示配置
     *
     * @return array
     */
    public static function getTableRows()
    {
        return [
            [
                'key' => 'id',
                'val' => 'id',
            ],
            [
                'key' => 'name',
                'val' => '标签名',
            ],
            [
                'key' => 'created_at',
                'val' => '创建时间',
            ],
            [
                'key' => 'updated_at',
                'val' => '修改时间',
            ],
        ];
    }

    /**
     * 详情通用显示配置
     *
     * @return array
     */
    public static function getItemRows()
    {
        return [
            [
                'key' => 'id',
                'val' => 'id',
            ],
            [
                'key' => 'name',
                'val' => '标签名',
            ],
            [
                'key' => 'created_at',
                'val' => '创建时间',
            ],
            [
                'key' => 'updated_at',
                'val' => '修改时间',
            ],
        ];
    }
}
