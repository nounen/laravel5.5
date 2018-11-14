<?php
/**
 * 模板中使用的函数： 为了尽量减少在模板写各种表达式
 */

if (! function_exists('attrToStr')) {
    /**
     * HTML 属性拼接
     * @param $field
     * @return mixed
     */
    function attrToStr($attrs)
    {
        $attrStr = '';

        foreach ($attrs as $attrKey => $attr) {
            $attrStr .= " {$attrKey}=\"{$attr}\"";
        }

        return $attrStr;
    }
}

if (! function_exists('getHiddenClass')) {
    /**
     * css 类 hidden
     * @param $field
     * @return string
     */
    function getHiddenClass($field)
    {
        return str_contains($field['attribute'], 'hidden') ? 'hidden' : '';
    }
}

if (! function_exists('getCheckedResult')) {
    /**
     * radio checkbox 选中效果计算
     * @param $option
     * @param $oldValue
     * @return string
     */
    function getCheckedResult($option, $field)
    {
        return $option['value'] == old($field['key'], $field['value']) ? 'checked' : '';
    }
}

if (! function_exists('getSelectName')) {
    /**
     * select 的name属性计算
     * @param $field
     * @param $field
     * @return string
     */
    function getSelectName($field)
    {
        return strpos($field['attribute'], 'multiple') ? "{$field['key']}[]" : $field['key'];
    }
}

if (! function_exists('getSelectResult')) {
    /**
     * select 的 selected 选中效果计算
     * @param $option
     * @param $field
     * @return string
     */
    function getSelectResult($value, $oldValue)
    {
        return $value == $oldValue ? 'selected' : '';
    }
}