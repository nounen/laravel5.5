<?php

// 路由别名决定视图位置。
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Auth::routes();

    Route::get('', function() {
        return redirect(url('admin/login'));
    });

    // auth 中间件： 需要登录验证业务
    Route::middleware(['auth'])->group(function () {
        // 标签管理
        Route::prefix('tag')->name('tag.')->group(function() {
            // 列表页面, 详情页面, 删除数据
            Route::get('', 'TagController@index')->name('index');
            Route::get('{id}', 'TagController@show')->name('show');
            Route::delete('{id}', 'TagController@destroy')->name('destroy');

            // 创建页面, 保存数据
            Route::get('create', 'TagController@create')->name('create');
            Route::post('', 'TagController@store')->name('store');

            // 编辑页面, 更新数据
            Route::get('{id}/edit', 'TagController@edit')->name('edit');
            Route::patch('{id}', 'TagController@update')->name('update');
        });

        // 分类管理
        Route::prefix('category')->name('category.')->group(function() {
            // 列表页面, 详情页面, 删除数据
            Route::get('', 'CategoryController@index')->name('index');
            Route::get('{id}', 'CategoryController@show')->name('show');
            Route::delete('{id}', 'CategoryController@destroy')->name('destroy');

            // 创建页面, 保存数据
            Route::get('create', 'CategoryController@create')->name('create');
            Route::post('', 'CategoryController@store')->name('store');

            // 编辑页面, 更新数据
            Route::get('{id}/edit', 'CategoryController@edit')->name('edit');
            Route::patch('{id}', 'CategoryController@update')->name('update');
        });

        // 文章管理
        Route::prefix('article')->name('article.')->group(function() {
            // 列表页面, 详情页面, 删除数据
            Route::get('', 'ArticleController@index')->name('index');
            Route::get('{id}', 'ArticleController@show')->name('show');
            Route::delete('{id}', 'ArticleController@destroy')->name('destroy');

            // 创建页面, 保存数据
            Route::get('create', 'ArticleController@create')->name('create');
            Route::post('', 'ArticleController@store')->name('store');

            // 编辑页面, 更新数据
            Route::get('{id}/edit', 'ArticleController@edit')->name('edit');
            Route::patch('{id}', 'ArticleController@update')->name('update');
        });
    });
});
