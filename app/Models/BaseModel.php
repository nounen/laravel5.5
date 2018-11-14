<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use function PHPSTORM_META\type;

/**
 * 模型基础
 *
 */
class BaseModel extends Model
{
    use SoftDeletes;

    const YES = 1;
    const YES_NAME = '是';

    const NO = 2;
    const NO_NAME = '否';

    public static function getIsStates()
    {
        return [
            [
                'value' => self::YES,
                'name'  => self::YES_NAME,
            ],
            [
                'value' => self::NO,
                'name'  => self::NO_NAME,
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
        $keys = self::tableKeys();
        $fields = self::getFields();

        foreach ($keys as $key) {
            $field = $fields[$key];
            $rows[$key]['name'] = $field['name'];
            $rows[$key]['is_slot'] = array_get($field, 'slots.table', false); // slot
        }

        return $rows;
    }

    /**
     * 字段处理
     *
     * @return array
     */
    public static function dealFields($keys, $fields)
    {
        $rows = [];

        foreach ($keys as $key) {
            $field = $fields[$key];
            // 表单元素通用属性
            $rows[$key] = [
                'key'       => $key,
                'name'      => $field['name'],
                'element'   => array_get($field, 'element'),
                'value'     => array_get($field, 'value'),
                'options'   => array_get($field, 'options'),
                'attribute' => attrToStr(array_get($field, 'attributes', [])),
            ];
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
        return self::dealFields(self::detailKeys(), self::getFields());
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
        return self::dealFields(self::createKeys(), self::getFields());
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
        return self::dealFields(self::updateKeys(), self::getFields());
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

    /**
     * 创建人作用域
     * @param $query
     * @return mixed
     */
    public function scopeOfUser($query)
    {
        return $query->where('user_id', self::adminUser()->id);
    }
}
