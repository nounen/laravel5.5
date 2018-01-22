<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 模型基础
 *
 */
class BaseModel extends Model
{
    use SoftDeletes;

    /**
     * 表单校验规则
     *
     * @return array
     */
    public static function getRequestRules()
    {
        $rules = [];

        $fields = self::getFields();

        foreach($fields as $field) {
            if (isset($field['rule'])) {
                $rules[$field['key']] = $field['rule'];
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

        foreach($fields as $field) {
            $attributes[$field['key']] = $field['name'];
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

        foreach($fields as $field) {
            if (issetAndEqual($field, 'table', true)) {
                $rows[] = [
                    'key'  => $field['key'],
                    'name' => $field['name'],
                ];
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

        foreach($fields as $field) {
            if (issetAndEqual($field, 'detail', true)) {
                $rows[] = [
                    'key'  => $field['key'],
                    'name' => $field['name'],
                ];
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

        foreach($fields as $field) {
            if (issetAndEqual($field, 'create', true)) {
                $rows[] = [
                    'key'  => $field['key'],
                    'name' => $field['name'],
                    'attr' => $field['create'],
                ];
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

        $keys = array_pluck($fields, 'key');

        return $keys;
    }
}