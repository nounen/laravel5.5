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
    use SoftDeletes, BaseModelTrait;

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
