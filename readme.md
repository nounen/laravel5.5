### 安装
```
git pull

composer install

cp .env.example .env

php artisan key:generate

创建数据库 laravel_build
php artisan migrate

php artisan serve
```



### AdminLTE 后台模板
* 官网: https://adminlte.io/

* 文档: https://adminlte.io/docs/2.4/installation

* 依赖插件: https://adminlte.io/docs/2.4/dependencies

* 官方案例: https://adminlte.io/themes/AdminLTE/

* `npm run dev` 生成压缩文件.

```html
* adminlte_app.blade.php 支持传参, 是否隐藏 header footer sidebar
@extends('layouts.adminlte_app', ['hidden_header' => true, 'hidden_footer' => true, 'hidden_sidebar' => true])

```


### 迁移文件
* `php artisan make:migration create_users_table --[create|table]=users`

* 表名 / 字段名 尽量都 **单数**.


### 模型
* `php artisan make:model Models/User [--migration]`


### 控制器
* `php artisan make:controller UserController --resource --model=Models/User`

### 表单验证
* `php artisan make:request Admin/TagPost`

### CURD 通用后台设计
* 要点: 通过配置实现

* 列表: _index
    * 列表数据
    * 编辑入口: 创建 / 编辑 / 查看 / 删除 (权限)
        * TODO: 如何扩展更多操作权限的入口按钮
* 新增: _create
* 编辑: _update
* 查看: _detail
* 删除: _delete

### 表单
* http://www.w3school.com.cn/html/html_forms.asp
* http://www.w3school.com.cn/html/html_form_elements.asp
* http://www.w3school.com.cn/html/html_form_input_types.asp
* http://www.w3school.com.cn/html/html_form_attributes.asp


### 通用表单完整案例
* form 表: id, text, date, datetime, textarea, password, radio, file, image,  

* form_checkbox 表: id, form_id, checkbox


### 策略 -- policy
* `php artisan make:policy TagPolicy --model=Models/Tag`

* policy 两种处理方式:
```php
// 策略处理方式 1
if ($this->auth->cant('view', $tag)) {
    dd('策略处理方式 1!');
}

// 策略处理方式 2
$this->authorize('view', $tag);
```


### index.blade.php
```
// 模板 fields 变量 eg： 
array:5 [▼
  "id" => array:2 [▶
    "name" => "主键"
    "is_slot" => false
  ]
  "name" => array:2 [▶
    "name" => "标签名"
    "is_slot" => true
  ]
  "sort" => array:2 [▶
    "name" => "排序"
    "is_slot" => false
  ]
  "created_at" => array:2 [▶
    "name" => "创建时间"
    "is_slot" => false
  ]
  "updated_at" => array:2 [▶
    "name" => "更新时间"
    "is_slot" => false
  ]
]
```


### 资源上传
* 软连接设置 `php artisan storage:link`


### npm
* npm install
* npm run xxx


### TODO
* create.blade.php
    * 文件选择： 1.删除选中文件； 2.再次选择文件时没有选，但是图片预览还是存在；

* []表单元素整理

* []权限管理

* []搜索支持排序

* 
