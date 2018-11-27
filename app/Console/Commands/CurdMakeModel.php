<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\DB;

/**
 * 模型生成，在 app/Models/ 目录下
 * eg: `php artisan curd:make_model Permission`
 * Class CurdMakeModel
 * @package App\Console\Commands
 */
class CurdMakeModel extends GeneratorCommand
{
    protected $name = 'curd:make_model';

    protected $description = '模型生成';

    protected $type = 'Model';

    /**
     * 获取模板
     *
     * @return string
     */
    protected function getStub()
    {
        $modelTemp = $this->setTemplateMore();

        if ($modelTemp) {
            return $modelTemp;
        }

        return __DIR__.'/stubs/model.stub';
    }

    /**
     * 模型生成模板扩展： table 属性  和  fillable 属性支持
     * @return string
     */
    protected function setTemplateMore()
    {
        $table = snake_case($this->getNameInput());
        $modelName = studly_case($this->getNameInput());
        $tables = $this->getTables();

        // 表存在
        if (in_array($table, $tables)) {
            $content = file_get_contents(__DIR__.'/stubs/model.stub');

            $content = $this->dealModelName($content, $modelName);

            $content = $this->dealAttrTable($content, $table);

            $columns = $this->getTableColumns($table);
            $fillable = $this->getFillableColumns($columns);
            $content = $this->dealAttrFillable($content, $fillable);

            // 生成新模板
            if (file_put_contents(__DIR__.'/stubs/model_tmp.stub', $content)) {
                return __DIR__.'/stubs/model_tmp.stub';
            }
        }
    }

    /**
     * 模型生成： 模型名替换
     * @param $content
     * @param $modelName
     * @return mixed
     */
    protected function dealModelName($content, $modelName)
    {
        return str_replace("ModelName", $modelName, $content);
    }

    /**
     * 模型生成： $fillable 属性
     * @param $content
     * @param $fillable
     * @return mixed
     */
    protected function dealAttrFillable($content, $fillable)
    {
        $fillableStr = "protected \$fillable = [\n";

        foreach ($fillable as $key => $field) {
            $fillableStr .=
                ($field == end($fillable)) ?
                    "\t\t'{$field}'," :
                    "\t\t'{$field}',\n";
        }

        $content = str_replace("protected \$fillable = [\n", $fillableStr, $content);

        return $content;
    }

    /**
     * 模型生成： $table 属性
     * @param $content
     * @param $table
     * @return mixed
     */
    protected function dealAttrTable($content, $table)
    {
        return str_replace("\$table = ''", "\$table = '{$table}'", $content);
    }

    /**
     * 获取模型的 fillable 字段
     */
    protected function getFillableColumns($columns)
    {
        // 用于 fillable 的字段
        return array_filter($columns, function($value) {
            return ! in_array($value, [
                'id',
            ]);
        });
    }

    /**
     * 获取表中所有字段
     * @param $table
     * @return array
     */
    protected function getTableColumns($table)
    {
        return array_map('reset', DB::select("SHOW COLUMNS FROM `{$table}`"));
    }

    /**
     * 获取数据库中所有表 表明
     * @return array
     */
    protected function getTables()
    {
        return array_map('reset', DB::select('SHOW TABLES'));
    }

    /**
     * 默认命名空间
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Models';
    }
}
