<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

/**
 * Class Tag
 * @package App\Models
 */
class Tag extends BaseModel
{
    use TagTrait;

    protected $table = 'tag';

    protected $fillable = [
        'name',
        'sort',
        'user_id',
    ];

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
