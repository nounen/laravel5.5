<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->comment('上级menu');
            $table->string('alias')->comment('路由别名:权限控制用');
            $table->string('name')->default('')->comment('路由名');
            $table->string('icon')->default('')->comment('图标');
            $table->string('description')->default(0)->comment('更多描述');
            $table->integer('sort')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('alias', 'index_alias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
