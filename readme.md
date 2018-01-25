### 安装
```
git pull

composer install

cp .env.example .env

.env 添加配置项 APP_LOG=daily

php artisan key:generate

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