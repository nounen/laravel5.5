<?php

namespace App\Models;

/**
 * Class Article
 * @package App\Models
 */
class Article extends BaseModel
{
    use ArticleTrait;

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

// 并不需要 append， 只要做好关联模型的预加载即可。
//    protected $appends = [
//        'article_state_name',
//        'is_allow_comment_name',
//        'user_name',
//        'cover_url',
//        'tag_ids',
//    ];

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

    /**
     * 封面链接
     * @return mixed
     */
    public function getCoverUrlAttribute()
    {
        return !empty($this->cover) ? getAssetUrl($this->cover) : $this->cover;
    }

    /**
     * 关联的标签 ids
     * @return array
     */
    public function getTagIdsAttribute()
    {
        return array_pluck($this->tags, 'id');
    }
}
