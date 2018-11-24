<?php

Route::namespace('Admin')->prefix('admin')->group(function () {
    // 登录相关
    Auth::routes();
});

// auth 中间件： 需要登录验证业务
// 不需要权限控制： 不写 name， 或者 'XX权限_ignore'
Route::namespace('Admin')->prefix('admin')->middleware(['auth'])->group(function () {
    // 后台首页
    Route::get('', 'AdminController@index')->name('index');

    // 博客管理模块
    Route::name('博客管理')->group(function () {
        // 标签管理
        Route::prefix('tag')->name('.标签管理')->group(function() {
            // 列表页面, 详情页面, 删除数据
            Route::get('', 'TagController@index')->name('.标签列表');
            Route::get('{id}', 'TagController@show')->name('.标签详情');
            Route::delete('{id}', 'TagController@destroy')->name('.标签删除');

            // 创建页面, 保存数据
            Route::get('create', 'TagController@create')->name('.标签创建_ignore');
            Route::post('', 'TagController@store')->name('.标签创建');

            // 编辑页面, 更新数据
            Route::get('{id}/edit', 'TagController@edit');
            Route::patch('{id}', 'TagController@update')->name('.标签修改');
        });

        // 分类管理
        Route::prefix('category')->name('.分类管理')->group(function() {
            // 列表页面, 详情页面, 删除数据
            Route::get('', 'CategoryController@index')->name('.分类列表');
            Route::get('{id}', 'CategoryController@show')->name('.分类详情');
            Route::delete('{id}', 'CategoryController@destroy')->name('.分类删除');

            // 创建页面, 保存数据
            Route::get('create', 'CategoryController@create');
            Route::post('', 'CategoryController@store')->name('.分类创建');

            // 编辑页面, 更新数据
            Route::get('{id}/edit', 'CategoryController@edit');
            Route::patch('{id}', 'CategoryController@update')->name('.分类修改');
        });

        // 文章管理
        Route::prefix('article')->name('.文章管理')->group(function() {
            // 列表页面, 详情页面, 删除数据
            Route::get('', 'ArticleController@index')->name('.文章列表');
            Route::get('{id}', 'ArticleController@show')->name('.文章详情');
            Route::delete('{id}', 'ArticleController@destroy')->name('.文章删除');

            // 创建页面, 保存数据
            Route::get('create', 'ArticleController@create');
            Route::post('', 'ArticleController@store')->name('.文章创建');

            // 编辑页面, 更新数据
            Route::get('{id}/edit', 'ArticleController@edit');
            Route::patch('{id}', 'ArticleController@update')->name('.文章修改');
        });
    });
});
