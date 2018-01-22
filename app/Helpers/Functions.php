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