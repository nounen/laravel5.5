<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * 模型基础
 *
 */
class BaseModel extends Model
{
    use SoftDeletes;

    const YES = 1;

    const NO = 2;

    public static function getIsStates()
    {
        return [
            [
                'value' => self::YES,
                'name'  => '是',
            ],
            [
                'value' => self::NO,
                'name'  => '否',
            ],
        ];
    }

    /**
     * 表单校验规则
     *
     * @return array
     */
    public static function getRequestRules()
    {
        $rules = [];

        $fields = self::getFields();

        foreach($fields as $fieldKey => $field) {
            if (isset($field['rule'])) {
                $rules[$fieldKey] = $field['rule'];
            } else {
                continue;
            }
        }

        return $rules;
    }

    /**
     * 表单校验属性名 (中文名)
     *
     * @return array
     */
    public static function getRequestAttributes()
    {
        $attributes = [];

        $fields = self::getFields();

        foreach($fields as $fieldKey => $field) {
            $attributes[$fieldKey] = $field['name'];
        }

        return $attributes;
    }

    /**
     * 列表显示字段
     *
     * @return array
     */
    public static function getTableRows()
    {
        $rows = [];

        $fields = self::getFields();

        foreach($fields as $fieldKey => $field) {
            if (isset($field['table'])) {
                $rows[$fieldKey] = is_bool($field['table']) ? $field['name'] : ['name' => $field['name'], 'type' => $field['table']];
            } else {
                continue;
            }
        }

        return $rows;
    }


    /**
     * 详情显示字段
     *
     * @return array
     */
    public static function getDetailRows()
    {
        $rows = [];

        $fields = self::getFields();

        foreach($fields as $fieldKey => $field) {
            if (isset($field['detail'])) {
                $rows[$fieldKey] = is_bool($field['detail']) ? $field['name'] : ['name' => $field['name'], 'type' => $field['detail']];
            } else {
                continue;
            }
        }

        return $rows;
    }

    /**
     * 创建页面字段
     *
     * @return array
     */
    public static function getCreateRows()
    {
        $rows = [];

        $fields = self::getFields();

        foreach($fields as $fieldKey => $field) {
            if (isset($field['create']) && $field['create']) {
                // 表单元素通用属性
                $row = [
                    'key'       => $fieldKey,
                    'name'      => $field['name'],
                    'element'   => array_get($field, 'element'),
                    'attribute' => null,
                    'options'   => array_get($field, 'create.options', array_get($field, 'options')), // 优先 create
                ];

                // HTML 属性拼接
                $attrs = array_get($field, 'attributes', array_get($field, 'create.attributes', []));

                foreach ($attrs as $attrKey => $attr) {
                    $row['attribute'] .= " {$attrKey}=\"{$attr}\"";
                }

                $rows[] = $row;
            } else {
                continue;
            }
        }

        return $rows;
    }

    /**
     * 在 getCreateRows 只提取 key
     *
     * @return array
     */
    public static function getStoreKeys()
    {
        $fields = self::getCreateRows();

        // 字段过滤: 含有 'disabled', 'readonly', 'hidden' 属性的不计入
        $fields = array_filter($fields, function($filter) {
            if (str_contains($filter['attribute'], ['disabled', 'readonly', 'hidden'])) {
                return false;
            }

            return true;
        });

        $keys = array_pluck($fields, 'key');

        return $keys;
    }

    /**
     * 更新页面字段
     *
     * @return array
     */
    public static function getUpdateRows()
    {
        $rows = [];

        $fields = self::getFields();

        foreach($fields as $fieldKey => $field) {
            if (isset($field['update']) && $field['update']) {
                // 表单元素通用属性
                $row = [
                    'key'       => $fieldKey,
                    'name'      => $field['name'],
                    'element'   => array_get($field, 'element'),
                    'attribute' => null,
                    'options'   => array_get($field, 'update.options', array_get($field, 'options')), // 优先 update
                ];

                // HTML 属性拼接
                $attrs = array_get($field, 'attributes', array_get($field, 'update.attributes', []));

                foreach ($attrs as $attrKey => $attr) {
                    $row['attribute'] .= " {$attrKey}=\"{$attr}\"";
                }

                $rows[] = $row;
            } else {
                continue;
            }
        }

        return $rows;
    }

    /**
     * 在 getUpdateRows 只提取 key
     *
     * @return array
     */
    public static function getUpdateKeys()
    {
        $fields = self::getUpdateRows();

        // 字段过滤: 含有 'disabled', 'readonly', 'hidden' 属性的不计入
        $fields = array_filter($fields, function($filter) {
            if (isset($filter['attribute'])) {
                if (str_contains($filter['attribute'], ['disabled', 'readonly', 'hidden'])) {
                    return false;
                }
            }

            return true;
        });

        $keys = array_pluck($fields, 'key');

        return $keys;
    }

    /**
     * 后台用户
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public static function adminUser()
    {
        return Auth::user();
    }
}