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