<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Role extends BaseModel
{
    use RoleTrait;

    protected $table = 'role';

    protected $fillable = [
        'name',
        'role_type',
        'description',
        'user_id',
    ];

    /* 角色类型 START */
    const TYPE_CUSTOM = 1;
    const TYPE_CUSTOM_NAME = '自定义';

    const TYPE_ADMIN = 99;
    const TYPE_ADMIN_NAME = '超级管理员';

    /**
     *  角色 => 权限 多对多
     */
    public function permissions()
    {
        return $this->belongsToMany(
            Permission::class,
            'role_permission', 'role_id', 'permission_id'
        );
    }

    public static function getRoleTypes()
    {
        return [
            [
                'value' => self::TYPE_CUSTOM,
                'name'  => self::TYPE_CUSTOM_NAME,
            ],
            [
                'value' => self::TYPE_ADMIN,
                'name'  => self::TYPE_ADMIN_NAME,
            ],
        ];
    }

    /**
     * 角色类型 转 中文
     * @return string
     */
    public function getRoleTypeNameAttribute()
    {
        return getAttributeName($this->getRoleTypes(), $this->role_type);
    }

    /**
     * 关联的权限 ids
     * @return array
     */
    public function getPermissionIdsAttribute()
    {
        return array_pluck($this->permissions, 'id');
    }

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

        return self::get($fields);
    }
}
