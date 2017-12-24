<?php

namespace App\Repositories;

use Auth;

/**
 * Class BaseRepository
 * @package App\Repositories
 */
class BaseRepository
{
    /**
     * 通用模型搜索
     * @param  [type] $model        [description]
     * @param  [type] $fieldMaps [description]
     * @return [Model]               [description]
     */
    protected function search($model, $fieldMaps)
    {
        $params = request()->all();

        $searchFields = array_keys($fieldMaps);

        if (is_string($model)) {
            $model = new $model;
        }

        foreach ($params as $key => $fields) {
            if (! is_array($fields)) {
                continue;
            }

            foreach ($fields as $field => $value) {
                // 不在搜索配置里的字段不参与 sql 条件的拼接
                if (! in_array($field, $searchFields)) {
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