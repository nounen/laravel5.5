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
