<?php

namespace App\Models;

/**
 * Class Category
 * @package App\Models
 */
class Category extends BaseModel
{
    use CategoryTrait;

    protected $table = 'category';

    protected $fillable = [
        'parent_id',
        'name',
        'sort',
        'user_id',
    ];
}
