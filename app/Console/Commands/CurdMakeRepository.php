<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

/**
 * 仓库生成： 在 app/Repositories/ 目录下
 * eg: `php artisan curd:make_repository Admin/RolePermission`
 * Class RepositoryMakeCommand
 * @package App\Console\Commands
 */
class CurdMakeRepository extends GeneratorCommand
{
    protected $name = 'curd:make_repository';

    protected $description = '生成仓库: php artisan curd:make_repository Admin/RolePermissionRepository';

    protected $type = 'Repository';

    /**
     * 获取模板
     *
     * @return string
     */
    protected function getStub()
    {
        $repositoryTemp = $this->setTemplateMore();

        if ($repositoryTemp) {
            return $repositoryTemp;
        }

        return __DIR__ . '/stubs/repository.stub';
    }

    /**
     * 仓库临时模板生成
     * @return string
     */
    protected function setTemplateMore()
    {
        $name = studly_case($this->getNameInput());
        $expName = explode('/', $name);
        $dirName = reset($expName);
        $modelName = str_replace('Repository', '', end($expName));

        // 表存在
        $content = file_get_contents(__DIR__.'/stubs/repository.stub');
        $content = str_replace('DirName', $dirName, $content);
        $content = str_replace('ModelName', $modelName, $content);

        // 生成新模板
        if (file_put_contents(__DIR__.'/stubs/repository_tmp.stub', $content)) {
            return __DIR__.'/stubs/repository_tmp.stub';
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
        return $rootNamespace.'\Repositories';
    }
}
