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

    const YES_STR = '是';

    const NO = 2;

    const NO_STR = '否';

    public static function getIsStates()
    {
        return [
            [
                'value' => self::YES,
                'name'  => self::YES_STR,
            ],
            [
                'value' => self::NO,
                'name'  => self::NO_STR,
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
    public static function getTableFields()
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
    public static function getDetailFields()
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
                    'options'   => array_get($field, 'update.options', array_get($field, 'options')),
                ];

                // HTML 属性拼接
                $attrs = array_get($field, 'attributes', array_get($field, 'update.attributes', []));

                foreach ($attrs as $attrKey => $attr) {
                    $row['attribute'] .= " {$attrKey}=\"{$attr}\"";
                }

                $rows[$fieldKey] = $row;
            } else {
                continue;
            }
        }

        return $rows;
    }

    /**
     * 详情显示字段钩子方法, 在 getDetailFields 后执行, 为 $item 对应的模型添加更多属性 (对象引用传递, 所以无需返回值)
     *
     * @param $item
     */
    public static function getDetailFieldsHook($item)
    {
    }

    /**
     * 创建页面字段
     *
     * @return array
     */
    public static function getCreateFields()
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
                    // 优先 update. 如果是函数会自动被调用
                    'options'   => array_get($field, 'create.options', array_get($field, 'options')),
                ];

                // HTML 属性拼接
                $attrs = array_get($field, 'attributes', array_get($field, 'create.attributes', []));

                foreach ($attrs as $attrKey => $attr) {
                    $row['attribute'] .= " {$attrKey}=\"{$attr}\"";
                }

                // 方便通过 key 覆盖某些属性
                $rows[$fieldKey] = $row;
            } else {
                continue;
            }
        }

        return $rows;
    }

    /**
     * 创建页面字段钩子方法, 在 getCreateFields 后执行, 为 $item 对应的模型添加更多属性 (对象引用传递, 所以无需返回值)
     *
     * @param $item
     */
    public static function getUpdateFieldsHook($item)
    {
    }

    /**
     * 在 getCreateFields 只提取 key
     *
     * @return array
     */
    public static function getStoreKeys()
    {
        $fields = self::getCreateFields();

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
    public static function getUpdateFields()
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
                    'options'   => array_get($field, 'update.options', array_get($field, 'options')),
                ];

                // HTML 属性拼接
                $attrs = array_get($field, 'attributes', array_get($field, 'update.attributes', []));

                foreach ($attrs as $attrKey => $attr) {
                    $row['attribute'] .= " {$attrKey}=\"{$attr}\"";
                }

                $rows[$fieldKey] = $row;
            } else {
                continue;
            }
        }

        return $rows;
    }

    /**
     * 在 getUpdateFields 只提取 key
     *
     * @return array
     */
    public static function getUpdateKeys()
    {
        $fields = self::getUpdateFields();

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