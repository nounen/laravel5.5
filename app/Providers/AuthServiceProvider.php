<?php

namespace App\Providers;

use App\Models\BaseModel;
use App\Policies\BaseModelPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * 应用的策略映射
     *
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        BaseModel::class => BaseModelPolicy::class,
    ];

    /**
     * 注册任意用户认证、用户授权服务
     *
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
