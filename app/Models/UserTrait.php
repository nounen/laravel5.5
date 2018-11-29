<?php

namespace App\Models;

trait UserTrait
{
    /**
     * 所有字段
     * @return array
     */
    public static function allFields()
	{
		return [
			'id' => [
				'name' => '主键',
				'element' => 'input',
				'slots' => [],
				'attributes' => [],
				'rule' => [],
			],

			'name' => [
				'name' => '名字',
				'element' => 'input',
				'slots' => [],
				'attributes' => [],
				'rule' => [],
			],

			'email' => [
				'name' => '邮箱',
				'element' => 'input',
				'slots' => [],
				'attributes' => [],
				'rule' => [],
			],

			'password' => [
				'name' => '密码',
				'element' => 'input',
				'slots' => [],
				'attributes' => [],
				'rule' => [
                    'required',
                    'min:6',
                ],
			],

			'remember_token' => [
				'name' => '',
				'element' => '',
				'slots' => [],
				'attributes' => [],
				'rule' => [],
			],

            'role_id' => [
                'name' => '角色',
                'element' => 'select',
                'options' => function() {
		            return Role::beOptions();
	            },
                'attributes' => [
                    'type'     => 'select',
                    'required' => 'required',
                ],
            ],

            'role_name' => [
                'name' => '角色',
                'element' => 'input',
            ],

			'created_at' => [
				'name' => '创建时间',
				'element' => 'input',
				'slots' => [],
				'attributes' => [],
				'rule' => [],
			],

			'updated_at' => [
				'name' => '更新时间',
				'element' => 'input',
				'slots' => [],
				'attributes' => [],
				'rule' => [],
			],

		];
	}

    /**
     * 搜索字段
     * @return array
     */
    public static function searchFields()
	{
		return [
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
			'name',
			'email',
            'role_name',
			'created_at',
			'updated_at',
		];
	}

    /**
     * 创建字段
     * @return array
     */
    public static function createKeys()
	{
		return [
		    'role_id',
			'name',
			'email',
			'password',
		];
	}

    /**
     * 编辑字段
     * @return array
     */
    public static function updateKeys()
	{
		return [
		    'role_id',
			'name',
			'email',
			'password',
		];
	}

    /**
     * 详情字段
     * @return array
     */
    public static function detailKeys()
	{
		return [
            'role_id',
			'name',
			'email',
			'password',
			'created_at',
			'updated_at',
		];
	}
}
