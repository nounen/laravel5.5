<?php

if (! function_exists('issetAndEqual')) {
    /**
     * 判定数组某个 $key 是否存在, 且值为 $value
     *
     * @param $array
     * @param $key
     * @param $value
     * @return bool
     */
    function issetAndEqual($array, $key, $value = true)
    {
        return isset($array[$key]) && $array[$key] == $value;
    }
}

if (! function_exists('isUpdateMethod')) {
    /**
     * 是否是更新操作, 也就是 method In 'PUT', 'PATCH'
     *
     * @param $method
     * @return bool
     */
    function isUpdateMethod($method)
    {
        return in_array($method, ['PUT', 'PATCH']);
    }
}