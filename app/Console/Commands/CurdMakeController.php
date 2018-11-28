<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

/**
 * 仓库生成： 在 app/Http/Controllers/ 目录下
 * eg: `php artisan curd:make_controller Admin/RolePermission`
 * Class CurdMakeController
 * @package App\Console\Commands
 */
class CurdMakeController extends GeneratorCommand
{
    protected $name = 'curd:make_controller';

    protected $description = '生成仓库: php artisan curd:make_controller Admin/RolePermissionController';

    protected $type = 'Controller';

    /**
     * 获取模板
     *
     * @return string
     */
    protected function getStub()
    {
        $controllerTemp = $this->setTemplateMore();

        if ($controllerTemp) {
            return $controllerTemp;
        }

        return __DIR__ . '/stubs/controller.stub';
    }

    /**
     * 仓库临时模板生成
     * @return string
     */
    protected function setTemplateMore()
    {
        // 数据准备
        $name = studly_case($this->getNameInput());
        $expName = explode('/', $name);
        $dirName = reset($expName);
        $ModelName = str_replace('Controller', '', end($expName));
        $modelName = lcfirst($ModelName); // 首字母小写
        $modelUrl = snake_case($ModelName); // 转为下划线

        // 内容替换
        $content = file_get_contents(__DIR__.'/stubs/controller.stub');
        $content = str_replace('DirName', $dirName, $content);
        $content = str_replace('ModelName', $ModelName, $content);
        $content = str_replace('modelName', $modelName, $content);
        $content = str_replace('modelUrl', $modelUrl, $content);

        // 生成新模板
        if (file_put_contents(__DIR__.'/stubs/controller_tmp.stub', $content)) {
            return __DIR__.'/stubs/controller_tmp.stub';
        }
    }

    /**
     * 默认命名空间
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Controllers';
    }
}
