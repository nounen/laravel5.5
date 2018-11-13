<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description')->comment('简介');
            $table->string('cover')->default('')->comment('封面');
            $table->longText('content')->comment('内容');
            $table->tinyInteger('article_state')->default(1)->comment('字典:文章状态');
            $table->tinyInteger('is_allow_comment')->default(1)->comment('是否允许评论');
            $table->integer('view_count')->default(0);
            $table->integer('sort')->default(999);
            $table->integer('category_id');
            $table->integer('user_id');
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
        Schema::dropIfExists('article');
    }
}
