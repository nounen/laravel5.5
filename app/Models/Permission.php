<?php

namespace App\Models;

class Permission extends BaseModel
{
    protected $table = 'permission';

    protected $fillable = [
        'parent_id',
        'name',
        'name_full',
        'uri',
        'action',
        'sort',
        'level',
    ];

    public static function beOptions()
    {
        $fields = [
            'id AS value',
            'name',
        ];

        return self::get($fields)->toArray();
    }
}
