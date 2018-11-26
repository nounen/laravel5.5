<?php

namespace App\Models;

trait RoleTrait
{
    public static function getSearchFields()
    {
        $input = request()->all();

        return [
            'role_type' => [
                'name' => '所在栏目',
                'element' => 'select',
                'default' => array_get($input, 'equal.role_type', ''),
                'options' => function() {
                    return Role::getRoleTypes();
                },
            ],
        ];
    }

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

            'name' => [
                'name'   => '角色名',
                'rule'   => [
                    'required',
                    'max:10'
                ],
                'element'=> 'input',
                'attributes' => [
                    'type'     => 'text',
                    'required' => 'required',
                ],
            ],

            'role_type' => [
                'name'   => '角色类型',
                'element'=> 'select',
                'options' => function() {
                    return Role::getRoleTypes();
                },
                'attributes' => [
                    'required' => 'required',
                ],
                'rule'   => [
                    'required',
                    'numeric',
                ],
            ],

            'role_type_name' => [
                'name' => '角色类型',
            ],

            'description' => [
                'name'   => '简介',
                'element'=> 'textarea',
                'attributes' => [
                    'required' => 'required',
                ],
                'rule'   => [
                    'required',
                ],
            ],

            'permission_ids' => [
                'name' => '角色权限',
                'element' => 'checkbox',
                'options' => function() {
                    return Permission::beOptions();
                },
                'attributes' => [
                    'type'     => 'checkbox',
                    'multiple' => 'multiple',
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

    public static function tableKeys()
    {
        return [
            'id',
            'name',
            'role_type_name',
            'created_at',
        ];
    }

    public static function createKeys()
    {
        return [
            'name',
            'description',
            'role_type',
            'permission_ids',
        ];
    }

    public static function detailKeys()
    {
        return [
            'id',
            'name',
            'description',
            'role_type',
            'permission_ids',
            'created_at',
            'updated_at',
        ];
    }

    public static function updateKeys()
    {
        return [
            'name',
            'description',
            'role_type',
            'permission_ids',
        ];
    }
}
