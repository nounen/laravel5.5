<?php

Route::namespace('Admin')->prefix('/admin')->name('admin.')->group(function () {
    Auth::routes();

    Route::get('/', function() {
        return redirect(url('admin/login'));
    });

    Route::middleware(['auth'])->group(function () {
        Route::resource('/tag', 'TagController');
    });
});
