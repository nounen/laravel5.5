<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

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
        'category_id',
        'user_id',
    ];

    protected $appends = [
        'article_state_name',
        'is_allow_comment_name',
        'user_name',
        'cover_url',
    ];

    // 发布
    const STATE_PUBLISH = 1;
    const STATE_PUBLISH_NAME = '发布';

    // 草稿
    const STATE_DRAFT = 2;
    const STATE_DRAFT_NAME = '草稿';

    public static function getArticleStates()
    {
        return [
            [
                'value' => self::STATE_PUBLISH,
                'name'  => self::STATE_PUBLISH_NAME,
            ],
            [
                'value' => self::STATE_DRAFT,
                'name'  => self::STATE_DRAFT_NAME,
            ],
        ];
    }

    /**
     * 关联标签, 多对多
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * 所属作者, 一对一
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 所属分类, 一对一
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * 发布状态转中文
     *
     * @return string
     */
    public function getArticleStateNameAttribute()
    {
        return getAttributeName($this->getArticleStates(), $this->article_state);
    }

    /**
     * 是否允许评论转中文
     *
     * @return string
     */
    public function getIsAllowCommentNameAttribute()
    {
        return getAttributeName($this->getIsStates(), $this->is_allow_comment);
    }

    /**
     * 创建人名字
     *
     * @return mixed
     */
    public function getUserNameAttribute()
    {
        // $this->user 来自预加载模型
        if ($this->user) {
            return $this->user->name;
        } else {
            return '';
        }
    }

    /**
     * 栏目名
     *
     * @return mixed
     */
    public function getCategoryNameAttribute()
    {
        // $this->user 来自预加载模型
        if ($this->category) {
            return $this->category->name;
        } else {
            return '';
        }
    }

    public function getCoverUrlAttribute()
    {
        return getAssetUrl($this->cover);
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
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'hidden',
                ],
            ],

            'title' => [
                'name'   => '标题',
                'rule'   => [
                    'required',
                    'max:10',
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
                'rule'   => [
                    'required',
                ],
                'element'=> 'textarea',
                'attributes' => [
                    'required' => 'required',
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
                'element'=> 'image-single',
            ],

            'content' => [
                'name'   => '内容',
                'rule'   => [
                    'required',
                ],
                'element'=> 'textarea',
                'attributes' => [
                    'rows' => 8,
                    'required' => 'required',
                ],
            ],

            'article_state' => [
                'name'   => '发布状态',
                'element'=> 'select',
                'value' => Article::STATE_DRAFT,
                'options' => Article::getArticleStates(),
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
                'options' => self::getIsStates(),
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
                'options' => Tag::beOptions(),
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
                'options' => Category::beOptions(),
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
                'update' => false,
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'text',
                    'disabled' => 'disabled',
                ],
            ],

            'updated_at' => [
                'name'   => '更新时间',
                'update' => false,
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
            'content',
            'article_state_name',
            'view_count',
            'is_allow_comment_name',
            'category_name',
            'user_name',
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

    public static function getUpdateFieldsHook($article)
    {
        // 对象引用传递, 所以无需返回值
        $article->tag_ids = Tag::getTagIds($article->id);
    }

    public static function getDetailFieldsHook($article)
    {
        $article->tag_ids = Tag::getTagIds($article->id);
    }
}
