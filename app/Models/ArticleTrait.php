<?php

namespace App\Models;

trait ArticleTrait
{
    public static function searchFields()
    {
        $input = request()->all();

        return [
            'category_id' => [
                'name' => '所在栏目',
                'element' => 'select',
                'default' => array_get($input, 'equal.category_id', ''),
                'options' => function() {
                    return Category::beOptions();
                },
            ],

            'created_at' => [
                'name' => '创建时间',
                'element' => 'date-range',
                'format' => 'YYYY-MM-DD HH:mm:ss',
                'date_start' => [
                    'placeholder' => '开始日期',
                    'default' => array_get($input, 'between.created_at.0', ''),
                ],
                'date_end' => [
                    'placeholder' => '结束日期',
                    'default' => array_get($input, 'between.created_at.0', ''),
                ],
            ],

            'dropdown' => [
                'name' => array_get($input, 'option_name', '请选择'),
                'default_key' => array_get($input, 'option_key', ''),
                'default_value' => array_get($input, 'option_value', ''),
                'element' => 'dropdown',
                'options' => [
                    [
                        'key' => 'title',
                        'name' => '标题',
                    ],
                    [
                        'key' => 'description',
                        'name' => '简介',
                    ],
                ],
            ],
        ];
    }

    /**
     * 所有字段
     *
     * @return array
     */
    public static function allFields()
    {
        return [
            'id' => [
                'name'   => '主键',
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'hidden',
                ],
            ],

            'title' => [
                'name'   => '标题',
                'rule'   => [
                    'required',
                    'max:200',
                ],
                'slots' => [
                    'table' => true,
                ],
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'text',
                    'required' => 'required',
                ],
            ],

            'description' => [
                'name'   => '简介',
                'element'=> 'textarea',
                'slots' => [
                    'table' => true,
                ],
                'attributes' => [
                    'required' => 'required',
                ],
                'rule'   => [
                    'required',
                ],
            ],

            'cover' => [
                'name'   => '封面',
                'element'=> 'input-image',
                'attributes' => [
                    'type' => 'file',
                ],
            ],

            'cover_url' => [
                'name'   => '封面',
                'element'=> 'show-single-image',
            ],

            'content' => [
                'name'   => '内容',
                'rule'   => [
                    'required',
                ],
                'element'=> 'wang-editor',
                //                'element'=> 'textarea',
                'attributes' => [
                    'rows' => 8,
                    'required' => 'required',
                ],
            ],

            'article_state' => [
                'name'   => '发布状态',
                'element'=> 'select',
                'value' => Article::STATE_DRAFT,
                'options' => function() {
                    return Article::getArticleStates();
                },
                'attributes' => [
                    'required' => 'required',
                ],
                'rule'   => [
                    'required',
                    'numeric',
                ],
            ],

            'article_state_name' => [
                'name'   => '发布状态',
            ],

            'view_count' => [
                'name'   => '浏览量',
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'number',
                    'disabled' => 'disabled',
                ],
            ],

            'is_allow_comment' => [
                'name'   => '允许评论',
                'element'=> 'radio',
                'options' => function() {
                    return parent::getIsStates();
                },
                'attributes' => [
                    'type'      => 'radio',
                    'required'  => 'required',
                ],
            ],

            'is_allow_comment_name' => [
                'name'   => '允许评论',
            ],

            'sort' => [
                'name'   => '排序',
                'element'=> 'input',
                'value' => 999, // 默认值
                'attributes' => [
                    'type'        => 'number',
                    'required'    => 'required',
                    'placeholder' => 999,
                ],
                'rule'   => [
                    'required',
                    'numeric'
                ],
            ],

            'tag_ids' => [
                'name' => '文章标签',
                'element' => 'select',
                'options' => function() {
                    return Tag::beOptions();
                },
                'attributes' => [
                    'type'     => 'select',
                    'required' => 'required',
                    'multiple' => 'multiple',
                ],
            ],

// checkbox 复选框配置。 不允许 required 属性，不然变成每个复选框都要勾选。
//            'tag_ids' => [
//                'name' => '文章标签',
//                'element' => 'checkbox',
//                'options' => Tag::beOptions(),
//                'attributes' => [
//                    'type'     => 'checkbox',
//                    'multiple' => 'multiple',
//                ],
//            ],

            'category_id' => [
                'name' => '文章栏目',
                'element' => 'select',
                'options' => function() {
                    return Category::beOptions();
                },
                'attributes' => [
                    'type'     => 'select',
                    'required' => 'required',
                ],
            ],

            'category_name' => [
                'name'   => '文章栏目',
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'text',
                    'disabled' => 'disabled',
                ],
            ],

            'user_id' => [
                'name'   => '创建人',
            ],

            'user_name' => [
                'name'   => '创建人',
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'text',
                    'disabled' => 'disabled',
                ],
            ],

            'created_at' => [
                'name'   => '创建时间',
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'text',
                    'disabled' => 'disabled',
                ],
            ],

            'updated_at' => [
                'name'   => '更新时间',
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'text',
                    'disabled' => 'disabled',
                ],
            ],
        ];
    }

    /**
     * 创建字段
     * @return array
     */
    public static function createKeys()
    {
        return [
            'title',
            'description',
            'cover',
            'content',
            'article_state',
            'is_allow_comment',
            'sort',
            'tag_ids',
            'category_id',
        ];
    }

    public static function updateKeys()
    {
        return [
            'title',
            'description',
            'cover',
            'content',
            'article_state',
            'is_allow_comment',
            'sort',
            'tag_ids',
            'category_id',
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
            'title',
            'description',
            'cover_url',
            'category_name',
            'is_allow_comment_name',
            'article_state_name',
            'created_at',
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
            'title',
            'description',
            'cover_url',
            'content',
            'article_state',
            'view_count',
            'is_allow_comment',
            'tag_ids',
            'category_id',
            'created_at',
            'updated_at',
        ];
    }
}
