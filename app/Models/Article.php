<?php

namespace App\Models;

/**
 * Class Article
 * @package App\Models
 */
class Article extends BaseModel
{
    protected $table = 'article';

    protected $fillable = [
        'title',
        'description',
        'cover',
        'content',
        'article_state',
        'is_allow_comment',
        'view_count',
        'sort',
        'user_id',
    ];

    // 发布
    const STATE_PUBLISH = 1;

    // 草稿
    const STATE_DRAFT = 2;

    public static function getArticleStates()
    {
        return [
            [
                'value' => self::STATE_PUBLISH,
                'name'  => '发布',
            ],
            [
                'value' => self::STATE_DRAFT,
                'name'  => '草稿',
            ],
        ];
    }

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
            'title' => [
                'name'   => '标题',
                'table'  => true,
                'detail' => true,
                'create' => true,
                'update' => true,
                'rule'   => ['required'],
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'text',
                    'required' => 'required',
                ],
            ],
            'description' => [
                'name'   => '简介',
                'table'  => true,
                'detail' => true,
                'create' => true,
                'update' => true,
                'rule'   => ['required'],
                'element'=> 'textarea',
                'attributes' => [
                    'required' => 'required',
                ],
            ],
            'cover' => [
                'name'   => '封面',
                'table'  => true,
                'detail' => true,
                'create' => true,
                'update' => true,
//                'rule'   => ['required'],
                'element'=> 'input',
                'attributes' => [
                    'type' => 'file',
//                    'required' => 'required',
                ],
            ],
            'content' => [
                'name'   => '内容',
                'table'  => true,
                'detail' => true,
                'create' => true,
                'update' => true,
                'rule'   => ['required'],
                'element'=> 'textarea',
                'attributes' => [
                    'rows' => 8,
                    'required' => 'required',
                ],
            ],
            'article_state' => [
                'name'   => '发布状态',
                'table'  => true,
                'detail' => true,
                'create' => true,
                'update' => true,
                'rule'   => 'required|numeric',
                'element'=> 'select',
                'attributes' => [
                    'required' => 'required',
                ],
                'options' => self::getArticleStates(),
            ],
            'view_count' => [
                'name'   => '浏览量',
                'table'  => true,
                'detail' => true,
                'update' => true,
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'number',
                    'disabled' => 'disabled',
                ],
            ],
            'is_allow_comment' => [
                'name'   => '允许评论',
                'table'  => true,
                'detail' => true,
                'create' => true,
                'update' => true,
                'element'=> 'radio',
                'attributes' => [
                    'type'      => 'radio',
                    'required'  => 'required',
                ],
                'options' => self::getIsStates(),
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
                    'type'        => 'number',
                    'required'    => 'required',
                    'placeholder' => 999,
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

    public function scopeOfUser($query)
    {
        return $query->where('user_id', self::adminUser()->id);
    }
}
