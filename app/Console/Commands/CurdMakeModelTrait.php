<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\DB;

/**
 * 模型生成，在 app/Models/ 目录下
 * eg: `php artisan curd:make_model_trait RolePermissionTrait`
 * Class CurdMakeModel
 * @package App\Console\Commands
 */
class CurdMakeModelTrait extends GeneratorCommand
{
    protected $name = 'curd:make_model_trait';

    protected $description = '模型生成';

    protected $type = 'Model';

    /**
     * 获取模板
     *
     * @return string
     */
    protected function getStub()
    {
        $modelTraitTemp = $this->setTemplateMore();

        if ($modelTraitTemp) {
            return $modelTraitTemp;
        }

        return __DIR__.'/stubs/model_trait.stub';
    }

    /**
     * 模型生成模板扩展： table 属性  和  fillable 属性支持
     * @return string
     */
    protected function setTemplateMore()
    {
        $inputName = str_replace('Trait', '', $this->getNameInput());
        $table = snake_case($inputName);
        $modelName = studly_case($inputName);
        $tables = $this->getTables();

        // 表存在
        if (in_array($table, $tables)) {
            $columns = $this->getTableColumns($table);
            $content = file_get_contents(__DIR__.'/stubs/model_trait.stub');
            $fields = $this->descTableColumns($table);

            $content = $this->dealModelName($content, $modelName);
            $content = $this->dealAllFieldsMethod($content, $table);
            $content = $this->dealSearchFieldsMethod($content, $columns);
            $content = $this->dealTableKeysMethod($content, $columns);
            $content = $this->dealCreateKeysMethod($content, $columns);
            $content = $this->dealUpdateKeysMethod($content, $columns);
            $content = $this->dealDetailKeysMethod($content, $columns);

            // 生成新模板
            if (file_put_contents(__DIR__.'/stubs/model_trait_tmp.stub', $content)) {
                return __DIR__.'/stubs/model_trait_tmp.stub';
            }
        } else {
            $this->error("{$table} 表不存在，请先创建！");
            exit();
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
     * 所有字段生成
     * @param $content
     * @param $table
     * @return mixed
     */
    protected function dealAllFieldsMethod($content, $table)
    {
        $fields = $this->descTableColumns($table);
        $str = "public static function allFields()\n";
        $str .= "\t{\n";
        $str .= "\t\treturn [\n";

        foreach ($fields as $field) {
            $name = $field->Field;
            $type = $field->Type;

            $str .= "\t\t\t'{$name}' => [\n";
            $str .= $this->getFieldName($name);
            $str .= $this->getFieldElement($name, $type);
            $str .= $this->getFieldOptions($name, $type);
            $str .= $this->getFieldSlots($name, $type);
            $str .= $this->getFieldAttributes($name, $type);
            $str .= $this->getFieldRule($name, $type);
            $str .= "\t\t\t],\n\n";
        }

        $str .= "\t\t];\n";
        $str .= "\t}";

        $content = str_replace("allFieldsMethod", $str, $content);
        return $content;
    }

    // 字段 options 属性
    protected function getFieldOptions($name, $type)
    {
        return "\t\t\t\t'options' => function() { return []; },\n";
    }

    // 字段 rule 属性
    protected function getFieldRule($name, $type)
    {
        return "\t\t\t\t'rule' => [],\n";
    }

    // 字段 slots 属性
    protected function getFieldSlots($name, $type)
    {
        return "\t\t\t\t'slots' => [],\n";
    }

    // 字段 attributes 属性
    protected function getFieldAttributes($name, $type)
    {
        return "\t\t\t\t'attributes' => [],\n";
    }

    // 字段 element 属性
    protected function getFieldElement($name, $type)
    {
        $value = '';

        if (str_contains($type, ['int', 'string'])) {
            $value = 'input';
        }

        return "\t\t\t\t'element' => '{$value}',\n";
    }

    // 字段 name 树形
    protected function getFieldName($name)
    {
        $trans = $this->commonTranslate();
        $cnName = isset($trans[$name]) ? $trans[$name] : '';
        return "\t\t\t\t'name' => '$cnName',\n";
    }

    /**
     * 常用字段翻译
     * @return array
     */
    protected function commonTranslate()
    {
        return [
            'id' => '主键',
            'title' => '标题',
            'description' => '简介',
            'cover' => '封面',
            'content' => '内容',
            'state' => '状态',
            'sort' => '排序',
            'user_id' => '创建人',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'deleted_at' => '删除时间',
        ];
    }

    /**
     * 生成搜索字段
     * @param $content
     * @param $columns
     * @return mixed
     */
    protected function dealSearchFieldsMethod($content, $columns)
    {
        $str = "public static function searchFields()\n";
        $str .= "\t{\n";
        $str .= "\t\treturn [\n";
        $str .= "\t\t];\n";
        $str .= "\t}";

        $content = str_replace("searchFieldsMethod", $str, $content);
        return $content;
    }

    /**
     * 生成表格字段
     * @param $content
     * @param $columns
     * @return mixed
     */
    protected function dealTableKeysMethod($content, $columns)
    {
        $str = "public static function tableKeys()\n";
        $str .= "\t{\n";
        $str .= "\t\treturn [\n";
        foreach ($columns as $key => $field) {
            $str .= "\t\t\t'{$field}',\n";
        }
        $str .= "\t\t];\n";
        $str .= "\t}";

        $content = str_replace("tableKeysMethod", $str, $content);
        return $content;
    }

    /**
     * 生成创建字段
     * @param $content
     * @param $columns
     * @return mixed
     */
    protected function dealCreateKeysMethod($content, $columns)
    {
        $str = "public static function createKeys()\n";
        $str .= "\t{\n";
        $str .= "\t\treturn [\n";
        foreach ($columns as $key => $field) {
            if (in_array($field, ['id'])) {
                continue;
            }
            $str .= "\t\t\t'{$field}',\n";
        }
        $str .= "\t\t];\n";
        $str .= "\t}";

        $content = str_replace("createKeysMethod", $str, $content);
        return $content;
    }

    /**
     * 生成编辑字段
     * @param $content
     * @param $columns
     * @return mixed
     */
    protected function dealUpdateKeysMethod($content, $columns)
    {
        $str = "public static function updateKeys()\n";
        $str .= "\t{\n";
        $str .= "\t\treturn [\n";
        foreach ($columns as $key => $field) {
            if (in_array($field, ['id'])) {
                continue;
            }
            $str .= "\t\t\t'{$field}',\n";
        }
        $str .= "\t\t];\n";
        $str .= "\t}";

        $content = str_replace("updateKeysMethod", $str, $content);
        return $content;
    }

    /**
     * 生成详情字段
     * @param $content
     * @param $columns
     * @return mixed
     */
    protected function dealDetailKeysMethod($content, $columns)
    {
        $str = "public static function detailKeys()\n";
        $str .= "\t{\n";
        $str .= "\t\treturn [\n";
        foreach ($columns as $key => $field) {
            $str .= "\t\t\t'{$field}',\n";
        }
        $str .= "\t\t];\n";
        $str .= "\t}";

        $content = str_replace("detailKeysMethod", $str, $content);
        return $content;
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
     * 表字段分析
     * @param $table
     * @return mixed
     */
    protected function descTableColumns($table)
    {
        return DB::select("DESC `{$table}`");
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
