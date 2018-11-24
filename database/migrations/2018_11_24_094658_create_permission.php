<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->string('name')->unique()->comment('权限名');
            $table->string('name_full')->default('')->comment('权限名完整');
            $table->string('uri')->default('');
            // 必须唯一，相同业务需要在不同模块控制权限那就写两个路由和控制器，业务代码指向同一个仓库方法即可
            $table->string('action')->default('')->index()->comment('控制器方法名');
            $table->integer('sort')->default(0);
            $table->integer('level')->default(0)->comment();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission');
    }
}
