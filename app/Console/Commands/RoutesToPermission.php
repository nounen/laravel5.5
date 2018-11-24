<?php

namespace App\Console\Commands;

use App\Models\Permission;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class RoutesToPermission extends Command
{
    protected $signature = 'seed:permission';

    protected $description = '权限填充: 按照层级 (必须是三级做填充)';

    protected $errorRoutes = [];

    protected $ignoreRoutes = [];

    protected $dealRoutes = [];

    protected $existRoutes = [];

    public function handle()
    {
        $routes = Route::getRoutes();

        foreach ($routes as $route) {
            $this->dealRoute($route);
        }

//        $this->printErrorRoutes();
//        $this->printIgnoreRoutes();
    }

    protected function printErrorRoutes()
    {
        foreach ($this->errorRoutes as $errorRoute) {
            $this->warn($errorRoute);
        }
    }

    protected function printIgnoreRoutes()
    {
        foreach ($this->ignoreRoutes as $ignoreRoute) {
            $this->info($ignoreRoute);
        }
    }

    protected function dealRoute($route)
    {
        $uri = trim($route->uri);
        $name = trim($route->getName());
        $action = trim($route->getActionName());
        $method = $route->methods; // 貌似没用

        $nameArr = explode('.', $name);
        // 路由名字必须四层， eg： "后台管理.博客管理.文章管理.文章修改"
        if (count($nameArr) != 3) {
            array_push($this->errorRoutes, "错误路由: {$uri} - {$name} - $action");
            return;
        }

        if (str_contains($name, 'ignore')) {
            array_push($this->ignoreRoutes, "忽略路由: {$uri} - {$name} - $action");
            return;
        }

        // 必须是后台路由才进入权限管理
        if (! str_contains($uri, 'admin')) {
            array_push($this->errorRoutes, "错误路由: {$uri} - {$name} - $action");
            return;
        }

        $this->savePermission([
            'uri' => $uri,
            'uri_arr' => explode('/', $uri),

            'name_full' => $name,
            'name_arr' => $nameArr,

            'action' => $action,
            'action_arr' => explode('@', $action),
        ]);
    }

    // 三级权限保存
    protected function savePermission($route)
    {
        $p1 = $this->savePermissionLevel1($route);
        $p2 = $this->savePermissionLevel2($route, $p1);
        $p3 = $this->savePermissionLevel3($route, $p2);
    }

    // 第1级权限创建
    protected function savePermissionLevel1($route) {
        $data = [
            'parent_id' => 0,
            'name' => $route['name_arr'][0],
            'name_full' => $route['name_arr'][0],
            'uri' => $route['uri_arr'][0],
            'action' => '',
            'level' => 1,
        ];

        $p1 = Permission::firstOrCreate($data);
        return $p1;
    }

    // 第2级权限创建
    protected function savePermissionLevel2($route, $p1) {
        $data = [
            'parent_id' => $p1->id,
            'name' => $route['name_arr'][1],
            'name_full' => "{$route['name_arr'][0]}.{$route['name_arr'][1]}",
            'uri' => "{$route['uri_arr'][0]}/{$route['uri_arr'][1]}",
            'action' => $route['action_arr'][0],
            'level' => 2,
        ];

        $p2 = Permission::firstOrCreate($data);
        return $p2;
    }

    // 第3级权限创建
    protected function savePermissionLevel3($route, $p2) {
        $data = [
            'parent_id' => $p2->id,
            'name' => $route['name_arr'][2],
            'name_full' => "{$route['name_arr'][0]}.{$route['name_arr'][1]}.{$route['name_arr'][2]}",
            'uri' => $route['uri'],
            'action' => $route['action'],
            'level' => 3,
        ];

        $p3 = Permission::firstOrCreate($data);
        return $p3;
    }

    protected function getPermissionByName($name)
    {
        return Permission::where('name', $name)->first();
    }
}
