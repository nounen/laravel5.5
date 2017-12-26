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
}
