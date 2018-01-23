<?php

namespace App\Models;

/**
 * Class Tag
 * @package App\Models
 */
class Form extends BaseModel
{
    protected $table = 'form';

    protected $fillable = [
        '*',
    ];

    /**
     * 所有字段
     *
     * @return array
     */
    public static function getFields()
    {
        return [];
    }
}
