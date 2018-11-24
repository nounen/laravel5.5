<?php

// 路由别名决定视图位置。
Route::namespace('Admin')->prefix('admin')->name('后台管理.')->group(function () {
    // 登录相关
    Auth::routes();

    // 后台首页
    Route::get('', 'AdminController@index')->name('index');

    // auth 中间件： 需要登录验证业务
    Route::middleware(['auth'])->group(function () {
        // 标签管理
        Route::prefix('tag')->name('标签管理.')->group(function() {
            // 列表页面, 详情页面, 删除数据
            Route::get('', 'TagController@index')->name('标签列表页');
            Route::get('{id}', 'TagController@show')->name('标签详情页');
            Route::delete('{id}', 'TagController@destroy')->name('标签删除');

            // 创建页面, 保存数据
            Route::get('create', 'TagController@create')->name('标签创建页');
            Route::post('', 'TagController@store')->name('标签创建');

            // 编辑页面, 更新数据
            Route::get('{id}/edit', 'TagController@edit')->name('标签修改页');
            Route::patch('{id}', 'TagController@update')->name('标签修改');
        });

        // 分类管理
        Route::prefix('category')->name('分类管理.')->group(function() {
            // 列表页面, 详情页面, 删除数据
            Route::get('', 'CategoryController@index')->name('分类列表页');
            Route::get('{id}', 'CategoryController@show')->name('分类详情页');
            Route::delete('{id}', 'CategoryController@destroy')->name('分类删除');

            // 创建页面, 保存数据
            Route::get('create', 'CategoryController@create')->name('分类创建页');
            Route::post('', 'CategoryController@store')->name('分类创建');

            // 编辑页面, 更新数据
            Route::get('{id}/edit', 'CategoryController@edit')->name('分类修改页');
            Route::patch('{id}', 'CategoryController@update')->name('分类修改');
        });

        // 文章管理
        Route::prefix('article')->name('文章管理.')->group(function() {
            // 列表页面, 详情页面, 删除数据
            Route::get('', 'ArticleController@index')->name('文章列表页');
            Route::get('{id}', 'ArticleController@show')->name('文章详情页');
            Route::delete('{id}', 'ArticleController@destroy')->name('文章删除');

            // 创建页面, 保存数据
            Route::get('create', 'ArticleController@create')->name('文章创建页');
            Route::post('', 'ArticleController@store')->name('文章创建');

            // 编辑页面, 更新数据
            Route::get('{id}/edit', 'ArticleController@edit')->name('文章修改页');
            Route::patch('{id}', 'ArticleController@update')->name('文章修改');
        });
    });
});
