<?php

Route::namespace('Admin')->prefix('/admin')->name('admin.')->group(function () {
    Auth::routes();

    Route::get('/', function() {
        return redirect(url('admin/login'));
    });

    Route::middleware(['auth'])->group(function () {
        Route::resource('/tag', 'TagController');

        Route::resource('/category', 'CategoryController');

        Route::resource('/article', 'ArticleController');

        Route::resource('/form', 'FormController');

        // 表单元素案例
        Route::get('/form_example', 'FormController@example');
        Route::post('/form_example', 'FormController@postExample');
    });
});
