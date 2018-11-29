<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

/**
 * 仓库生成： 在 app/Http/Requests/ 目录下
 * eg: `php artisan curd:make_request Admin/RolePermission`
 * Class CurdMakeRequest
 * @package App\Console\Commands
 */
class CurdMakeRequest extends GeneratorCommand
{
    protected $name = 'curd:make_request';

    protected $description = '生成表单验证: php artisan curd:make_request Admin/RolePermissionRequest';

    protected $type = 'Request';

    /**
     * 获取模板
     *
     * @return string
     */
    protected function getStub()
    {
        $requestTemp = $this->setTemplateMore();

        if ($requestTemp) {
            return $requestTemp;
        }

        return __DIR__ . '/stubs/request.stub';
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
        $ModelName = str_replace('Request', '', end($expName));
        $tableName = snake_case($ModelName); // 转为下划线

        // 内容替换
        $content = file_get_contents(__DIR__.'/stubs/request.stub');
        $content = str_replace('DirName', $dirName, $content);
        $content = str_replace('ModelName', $ModelName, $content);
        $content = str_replace('tableName', $tableName, $content);

        // 生成新模板
        if (file_put_contents(__DIR__.'/stubs/request_tmp.stub', $content)) {
            return __DIR__.'/stubs/request_tmp.stub';
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
        return $rootNamespace.'\Http\Requests';
    }
}
