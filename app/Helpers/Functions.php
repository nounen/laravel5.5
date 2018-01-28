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

if (! function_exists('getXxxNameAttribute')) {
    /**
     * 字典转中文
     *
     * @param $options
     * @param $value
     * @param string $default
     * @return string
     */
    function getXxxNameAttribute($options, $value, $default = '')
    {
        foreach ($options as $option) {
            if ($option['value'] == $value) {
                return $option['name'];
            }
        }

        return $default;
    }
}

if (!function_exists('search')) {
    /**
     * 模型搜索通用方法
     *
     * @param $model
     * @param $fieldMaps
     * @return mixed
     */
    function search($model, $fieldMaps)
    {
        $params = request()->all();

        $searchFields = array_keys($fieldMaps);

        if (is_string($model)) {
            $model = new $model;
        }

        foreach ($params as $key => $fields) {
            if (!is_array($fields)) {
                continue;
            }

            foreach ($fields as $field => $value) {
                // 不在搜索配置里的字段不参与 sql 条件的拼接
                if (!in_array($field, $searchFields)) {
                    continue;
                }

                $trueField = $fieldMaps[$field];

                switch ($key) {
                    case 'like' :
                        $model = $model->where($trueField, 'like', "%{$value}%");
                        break;
                    case 'equal' :
                        $model = $model->where($trueField, "{$value}");
                        break;
                    case 'in' :
                        $model = $model->whereIn($trueField, $value);
                        break;
                    case 'between' :
                        $model = $model->where($trueField, '>=', $value[0]);
                        $model = $model->where($trueField, '<=', $value[1]);
                        break;
                    case 'order' :
                        $model = $model->orderBy($trueField, $value);
                        break;
                }
            }
        }

        return $model;
    }
}