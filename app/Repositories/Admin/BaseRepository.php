<?php

namespace App\Repositories\Admin;


use Illuminate\Support\Facades\Auth;

/**
 * Class BaseRepository
 * @package App\Repositories
 */
class BaseRepository
{
    /**
     * 后台用户
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public static function adminUser()
    {
        return Auth::user();
    }
}
