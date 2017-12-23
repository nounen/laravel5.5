<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0)->comment('上级comment');
            $table->string('tour_name')->comment('评论人姓名');
            $table->ipAddress('tour_ip')->comment('评论人ip');
            $table->string('tour_user_agent')->comment('评论人浏览器HTTP_USER_AGENT');
            $table->tinyInteger('comment_state')->default(2)->comment('字典:评论状态');
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
        Schema::dropIfExists('comment');
    }
}
