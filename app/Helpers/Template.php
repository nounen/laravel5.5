<?php
/**
 * 模板中使用的函数： 为了尽量减少在模板写各种表达式
 */

if (! function_exists('getFieldName')) {
    /**
     * 字段名获取
     * @param $field
     * @return mixed
     */
    function getFieldName($field)
    {
        return is_array($field) ? $field['name'] : $field;
    }
}
